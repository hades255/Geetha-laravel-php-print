@extends('layouts.app')
@section('title', __('lang_v1.notification_templates'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('lang_v1.notification_templates')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    {!! Form::open(['url' => action('NotificationTemplateController@store'), 'method' => 'post' ]) !!}
    
    <div class="row no-print">
        <div class="col-md-12">
            <div class="settlement_tabs no-print">
                <ul class="nav nav-tabs  no-print">
                    <li class="active">
                        <a href="#customer_notifications" class="customer_notifications" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('lang_v1.customer_notifications')</strong>
                        </a>
                    </li>
                    
                    <li class="">
                        <a href="#supplier_notifications" class="supplier_notifications" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('lang_v1.supplier_notifications')</strong>
                        </a>
                    </li>
                    
                    <li class="">
                        <a href="#company_staff_notifications" class="company_staff_notifications" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('lang_v1.notifications')</strong>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="customer_notifications">
                        @component('components.widget', ['class' => 'box-primary','title' => " "])
                            @if($type == 'sms')
                                @include('notification_template.partials.sms', ['templates' => $customer_notifications])
                            @else
                                @include('notification_template.partials.email', ['templates' => $customer_notifications])
                            @endif
                        @endcomponent
                    </div>
                    
                    <div class="tab-pane" id="supplier_notifications">
                        @component('components.widget', ['class' => 'box-primary','title' => " "])
                            @if($type == 'sms')
                                @include('notification_template.partials.sms', ['templates' => $supplier_notifications])
                            @else
                                @include('notification_template.partials.email', ['templates' => $supplier_notifications])
                            @endif
                        @endcomponent
                    </div>
                    
                    <div class="tab-pane" id="company_staff_notifications">
                        @component('components.widget', ['class' => 'box-primary','title' => " "])
                            @if($type == 'sms')
                                    @include('notification_template.partials.sms', ['templates' => $general_notifications])
                            @else
                                @include('notification_template.partials.email', ['templates' => $general_notifications])
                            @endif
                        @endcomponent
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-danger btn-big">@lang('messages.save')</button>
        </div>
    </div>
    {!! Form::close() !!}

</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
    // $('textarea.ckeditor').each( function(){
    //     var editor_id = $(this).attr('id');
    //     tinymce.init({
    //         selector: 'textarea#'+editor_id,
    //     });
    // });
</script>
@endsection
