@extends('layouts.app')
@section('title', __('lang_v1.cash_flow'))

@section('content')


<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">@lang('lang_v1.cash_flow')</h4>
                <ul class="breadcrumbs pull-left" style="margin-top: 15px">
                    <li><a href="#">Account Reports</a></li>
                    <li><span>@lang('lang_v1.cash_flow')</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title"> <i class="fa fa-filter" aria-hidden="true"></i> @lang('report.filters'):</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-3 col-xs-6">
                        <label for="business_location">@lang('account.business_locations'):</label>
                        {!! Form::select('business_location', $business_locations, null, ['class' => 'form-control
                        select2',
                        'placeholder' =>__('lang_v1.all'), 'style' => 'width: 100%', 'id' => 'business_location']) !!}
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('account_id', __('account.account') . ':') !!}
                            {!! Form::select('account_id', $accounts, '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('transaction_date_range', __('report.date_range') . ':') !!}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                {!! Form::text('transaction_date_range', null, ['class' => 'form-control', 'readonly',
                                'placeholder' => __('report.date_range')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('transaction_type', __('account.transaction_type') . ':') !!}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                {!! Form::select('transaction_type', ['' => __('messages.all'),'debit' =>
                                __('account.debit'), 'credit' => __('account.credit')], '', ['class' => 'form-control'])
                                !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    @can('account.access')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="cash_flow_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'messages.date' )</th>
                                    <th>@lang( 'account.account' )</th>
                                    <th>@lang( 'lang_v1.description' )</th>
                                    <th>@lang('account.credit')</th>
                                    <th>@lang('account.debit')</th>
                                    <th>@lang( 'lang_v1.balance' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade account_model" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
<style>
    .dataTables_empty{
          color: {{App\System::getProperty('not_enalbed_module_user_color')}};
          font-size: {{App\System::getProperty('not_enalbed_module_user_font_size')}}px;
      }
  </style>
@section('javascript')
<script>
    $(document).ready(function(){

        dateRangeSettings.autoUpdateInput = false
        $('#transaction_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#transaction_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                var start = '';
                var end = '';
                if($('#transaction_date_range').val()){
                    start = $('input#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    end = $('input#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
                cash_flow_table.ajax.reload();
            }
        );
        
        // Cash Flow Table
        cash_flow_table = $('#cash_flow_table').DataTable({
            language: {
                "emptyTable": "@if(!$account_access) {{App\System::getProperty('not_enalbed_module_user_message')}} @else @lang('account.no_data_available_in_table') @endif"
            },
            processing: true,
            serverSide: true,
            "ajax": {
                    "url": "{{action("AccountController@cashFlow")}}",
                    "data": function ( d ) {
                        var start = '';
                        var end = '';
                        if($('#transaction_date_range').val() != ''){
                            start = $('#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            end = $('#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        }
                        
                        d.account_id = $('#account_id').val();
                        d.type = $('#transaction_type').val();
                        d.start_date = start;
                        d.end_date = end;
                        d.location_id =  $('select#business_location').val();
                    }
                },
            "ordering": false,
            "searching": false,
            columns: [
                {data: 'operation_date', name: 'operation_date'},
                {data: 'account_name', name: 'account_name'},
                {data: 'description', name: 'description'},
                {data: 'credit', name: 'amount'},
                {data: 'debit', name: 'amount'},
                {data: 'balance', name: 'balance'},
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#cash_flow_table'));
            }
        });
        $('#transaction_type, #account_id, #business_location').change( function(){
            cash_flow_table.ajax.reload();
        });
        $('#transaction_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#transaction_date_range').val('').change();
            cash_flow_table.ajax.reload();
        });

    });
</script>
@endsection