@inject('request', 'Illuminate\Http\Request')

@if(($request->segment(1) == 'pos' && ($request->segment(2) == 'create' || $request->segment(3) == 'edit') || ($request->segment(1) == 'purchase-pos') && ($request->segment(2) == 'create' || $request->segment(3) == 'edit')))
@php
$pos_layout = true;
@endphp
@else
@php
$pos_layout = false;
@endphp
@endif
@php
$settings = DB::table('site_settings')->where('id', 1)->select('*')->first();
$file = base_path($settings->uploadFileFicon);

@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ Session::get('business.name') }}</title>

    @if(!empty($settings->uploadFileFicon))
    <link rel="shortcut icon" type="image/x-icon" href="{{url($settings->uploadFileFicon)}}" />
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    @include('layouts.partials.css')


    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">


    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js?v=' . $asset_v) }}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>

    <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js?v=' . $asset_v) }}"></script>
    <!-- CSS file -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css" integrity="sha512-X6069m1NoT+wlVHgkxeWv/W7YzlrJeUhobSzk4J09CWxlplhUzJbiJVvS9mX1GGVYf5LA3N9yQW5Tgnu9P4C7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://kit.fontawesome.com/bb1c887317.js" crossorigin="anonymous"></script>

    @yield('css')
    <style>
        .lds-ripple-wrap {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: none;
            background-color: rgba(0, 0, 0, 0.41);

            text-align: center;
            padding-top: 206px;
        }

        .lds-ripple-wrap.active {
            display: block;

        }

        .bg-aqua {
            background-color: #00FFFF;
        }

        .bg-red {
            background-color: #FF0000;
        }

        .bg-yellow {
            background-color: #F7B304;
        }

        .lds-ripple {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ripple div {
            position: absolute;
            border: 4px solid #dfc;
            opacity: 1;
            border-radius: 50%;
            animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }

        .lds-ripple div:nth-child(2) {
            animation-delay: -0.5s;
        }

        @keyframes lds-ripple {
            0% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 0;
            }

            4.9% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 0;
            }

            5% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 1;
            }

            100% {
                top: 0px;
                left: 0px;
                width: 72px;
                height: 72px;
                opacity: 0;
            }
        }

        .border_shadow {
            border: 1px solid;
            padding: 10px
        }

        .main-content-inner {
            padding-top: 0px !important;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #fff;
            padding: 20px;
        }

        .content {
            margin-top: 0px;
            border-radius: 5px;
            background-color: #fff;
            padding: 20px;
        }

        .content-header {
            border-radius: 5px;
            background-color: #fff;
            padding: 10px;
            padding-left: 20px;
        }

        .content-header h1 {
            font-size: 22px !important;
        }

        .daterangepicker .ranges li.active {
            background-color: #8F3A84;
            color: #fff;
        }

        .daterangepicker td.active,
        .daterangepicker td.active:hover {
            background-color: #8F3A84;
            color: #fff;
        }

        .daterangepicker td.in-range {
            background-color: #FFADF5;
            border-color: transparent;
            color: #000;
            border-radius: 0;
        }

        .daterangepicker td.end-date {
            background-color: #8F3A84;
            color: #fff;
        }

        .daterangepicker .drp-selected {
            display: inline-block;
            font-size: 12px;
            padding-right: 8px;
            color: #8F3A84;
            font-weight: bold;
        }

        .daterangepicker .applyBtn {
            background-color: #8F3A84;
            color: #fff;
        }

        .dt-buttons .buttons-csv,
        .dt-buttons .buttons-excel,
        .dt-buttons .buttons-collection,
        .dt-buttons .buttons-pdf,
        .dt-buttons .buttons-print {
            background-color: #8F3A84;
            color: #fff;
            height: 30px !important;
        }


        body {
            font-family: Calibri, sans-serif !important;
        }
    </style>

    <style>
        .custom-overflow {
            overflow-y: auto;

        }

        .custom-overflow::-webkit-scrollbar {
            width: 14px;
        }

        ::-webkit-scrollbar {
            width: 11px;
            background-color: #40AFFF;
            border-radius: 5px !important;
            border: 2px solid #f1f1f1 !important;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #40AFFF;
            border-radius: 5px;
            border: 0.5px solid #f1f1f1;
        }

        .custom-overflow::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-overflow::-webkit-scrollbar-thumb {
            background-color: #40AFFF;
            border-radius: 5px;
            border: 2px solid #f1f1f1;
        }

        .nav-link {
            width: 100%;
            font-size: 12px !important;
        }
    </style>

</head>

<body style="font-family: Calibri, sans-serif !important;" class="@if($pos_layout) hold-transition lockscreen @else hold-transition skin-@if(!empty(session('business.theme_color'))){{session('business.theme_color')}}@else{{'blue'}}@endif sidebar-mini @endif">
    @include('layouts.partials.lock_screen')
    <div class="page-container custom-overflow">
        <script type="text/javascript">
            if (localStorage.getItem("upos_sidebar_collapse") == 'true') {
                var body = document.getElementsByTagName("body")[0];
                body.className += " sidebar-collapse";
            }
        </script>
        @if(!$pos_layout)
        @include('layouts.partials.sidebar')
        @else
        <!--@include('layouts.partials.header-pos')-->
        @endif
        <!-- Content Wrapper. Contains page content -->
        <div class="@if(!$pos_layout) main-content @endif" style="min-height: 100vh;">
            @if(!$pos_layout)
            @include('layouts.partials.header')
            @endif
            @php
            $business_id = session()->get('user.business_id');
            $business_details = App\Business::find($business_id);
            @endphp
            <!-- Add currency related field-->
            <input type="hidden" id="__code" value="{{session('currency')['code']}}">
            <input type="hidden" id="__symbol" value="{{session('currency')['symbol']}}">
            <input type="hidden" id="__thousand" value="{{session('currency')['thousand_separator']}}">
            <input type="hidden" id="__decimal" value="{{session('currency')['decimal_separator']}}">
            <input type="hidden" id="__symbol_placement" value="{{session('business.currency_symbol_placement')}}">
            <input type="hidden" id="__precision" value="@if(!empty($business_details->currency_precision)){{$business_details->currency_precision}}@else{{config('constants.currency_precision', 2)}}@endif">
            <input type="hidden" id="__quantity_precision" value="@if(!empty($business_details->quantity_precision)){{$business_details->quantity_precision}}@else{{config('constants.quantity_precision', 2)}}@endif">
            <!-- End of currency related field-->

            @if (session('status'))
            <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
            @endif
            @yield('content')
            @if(config('constants.iraqi_selling_price_adjustment'))
            <input type="hidden" id="iraqi_selling_price_adjustment">
            @endif
            <!-- This will be printed -->
            <section class="invoice print_section" id="receipt_section">
            </section>
        </div>
        @include('home.todays_profit_modal')
        <!-- /.content-wrapper -->
        @if(!$pos_layout)
        @include('layouts.partials.footer')
        @else
        @include('layouts.partials.footer_pos')
        @endif

        <audio id="success-audio">
            <source src="{{ asset('/audio/success.ogg?v=' . $asset_v) }}" type="audio/ogg">
            <source src="{{ asset('/audio/success.mp3?v=' . $asset_v) }}" type="audio/mpeg">
        </audio>
        <audio id="error-audio">
            <source src="{{ asset('/audio/error.ogg?v=' . $asset_v) }}" type="audio/ogg">
            <source src="{{ asset('/audio/error.mp3?v=' . $asset_v) }}" type="audio/mpeg">
        </audio>
        <audio id="warning-audio">
            <source src="{{ asset('/audio/warning.ogg?v=' . $asset_v) }}" type="audio/ogg">
            <source src="{{ asset('/audio/warning.mp3?v=' . $asset_v) }}" type="audio/mpeg">
        </audio>
        @if (!empty($register_success))
        @if($register_success['success'] == 1)
        <div class="modal" tabindex="-1" role="dialog" id="register_success_modal">
            <div class="modal-dialog" role="document" style="width: 55%;">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <i class="fa fa-check fa-lg" style="font-size: 50px; margin-top: 20px; border: 1px solid #4BB543; color: #4BB543; padding:15px 10px 15px 10px; border-radius: 50%;"></i>
                        <h2>{!!$register_success['title']!!}</h2>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            {!!$register_success['msg']!!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif
    </div>
    @include('layouts.partials.javascripts')

    <script>
        $(document).ready(function() {
            @if(!empty($register_success))
            @if($register_success['success'] == 1)
            $('#register_success_modal').modal('show');
            @endif
            @endif
        });
    </script>
    <script>
        $('.loading_gif').hide();
        $('#btnLock').click(function() {
            $('#lock_screen_div').show();
            $.ajax({
                method: 'post',
                url: '/lock_screen',
                data: {},
                success: function(result) {

                },
            });
            jQuery('html').css('overflow', 'hidden');
        });
        pelase_enter_password = "@lang('lang_v1.pelase_enter_password')";
        $('#check_password_btn').click(function() {
            let password = $('#lock_password').val();
            if (password == '') {
                $('.hide_p').text(pelase_enter_password);
            } else {
                $(this).hide();
                $('.loading_gif').show();
                $.ajax({
                    method: 'post',
                    url: '/check_user_password',
                    data: {
                        password: password
                    },
                    success: function(result) {
                        console.log(result.success);
                        if (result.success == 1) {
                            jQuery('html').css('overflow', 'scroll');
                            $('#lock_screen_div').addClass('animated', 'bounceOutLeft');
                            $('#lock_screen_div').hide();
                            $('#lock_password').val('');
                        } else if (result.success == 2) {
                            window.location.replace("{{route('login')}}");
                        } else {
                            $('.hide_p').text(result.msg);
                        }
                        $('#check_password_btn').show();
                        $('.loading_gif').hide();
                    },
                });
            }
        });

        $('#lock_password').keyup(function() {
            $('.hide_p').empty().append('&nbsp;');
        });
    </script>
    <div class="modal fade view_modal" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade view_modal_2" data-backdrop="static" role="dialog" aria-labelledby="gridSystemModalLabel" style="z-index:10001212"></div>
    <div class="stock_tranfer_notification_model">
    </div>
    <div class="lds-ripple-wrap">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
        <p>Please wait...</p>
    </div>

    <script>
        $('.payment_modal').on('hidden.bs.modal', function(e) {
            if ($.fn.DataTable.isDataTable('#view_payment_table')) {
                $('#view_payment_table').DataTable().destroy();
            }
            view_payment_table.destroy();
            $('#payment_filter_date_range').data('daterangepicker').remove()
        })
    </script>
    @php
    $reminders = \Modules\TasksManagement\Entities\Reminder::where('business_id',
    request()->session()->get('business.id'))->where('cancel', '0')->where('snooze', '0')->get();
    $snooze_reminder = \Modules\TasksManagement\Entities\Reminder::where('business_id',
    request()->session()->get('business.id'))->where('cancel', '0')->where('snooze', '1')->where('snoozed_at', '<=', date('Y-m-d H:i:s') )->get();
        @endphp

        @foreach ($reminders as $key => $value) {
        @if(($value->options == 'in_dashboard' || $value->options == 'when_login') && request()->path() == 'home')
        @include('layouts.partials.reminder_popup', ['value' => $value])
        @elseif($value->options == 'in_other_page')
        @if(in_array( request()->path(), $value->other_pages))
        @include('layouts.partials.reminder_popup', ['value' => $value])
        @endif
        @endif
        @if(!empty($value->crm_reminder_id))
        @include('layouts.partials.open_reminder', ['value' => $value])
        @include('layouts.partials.detail_reminder', ['value' => $value])
        @endif
        @endforeach

        @foreach ($snooze_reminder as $key => $value) {
        @if(($value->options == 'in_dashboard' || $value->options == 'when_login') && request()->path() == 'home')
        @include('layouts.partials.reminder_popup', ['value' => $value])
        @elseif($value->options == 'in_other_page')
        @if(in_array( request()->path(), $value->other_pages))
        @include('layouts.partials.reminder_popup', ['value' => $value])
        @endif
        @endif
        @if(!empty($value->crm_reminder_id))
        @include('layouts.partials.open_reminder', ['value' => $value])
        @include('layouts.partials.detail_reminder', ['value' => $value])
        @endif
        @endforeach
        <script>
            $('body').addClass('sidebar-collapse');
            $('.snooze_date').datepicker('setDate', new Date());
            $('.snooze_time').datetimepicker({
                format: 'HH:mm'
            });
        </script>
        <script>
            $(document).ready(function() {
                // $('.main-sidebar').css('width', '50px !important');
            });
        </script>
</body>

</html>