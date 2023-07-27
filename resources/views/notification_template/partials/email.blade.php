<style>
    .bg-custom{
        background-color: #F6CFD1;
    }
</style>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach($templates as $key => $value)
            <li @if($loop->index == 0) class="active" @endif>
                <a href="#cn_{{$key}}" data-toggle="tab" aria-expanded="true">
                <small>{{$value['name']}}</small> </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($templates as $key => $value)
            <div class="tab-pane @if($loop->index == 0) active @endif" id="cn_{{$key}}">
                <div class="col-md-12">
                <div class="col-md-12 bg-custom">
                    @if(!empty($value['extra_tags']))
                        <strong>@lang('lang_v1.available_tags'):</strong>
                    <p class="text-primary">{{implode(', ', $value['extra_tags'])}}</p>
                    @endif
                    @if(!empty($value['help_text']))
                    <p class="help-block">{{$value['help_text']}}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label($key . '_subject',
                        __('lang_v1.email_subject').':') !!}
                        {!! Form::text('template_data[' . $key . '][subject]', 
                        $value['subject'], ['class' => 'form-control'
                        , 'placeholder' => __('lang_v1.email_subject'), 'id' => $key . '_subject']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label($key . '_cc',
                        'CC:') !!}
                        {!! Form::email('template_data[' . $key . '][cc]', 
                        $value['cc'], ['class' => 'form-control'
                        , 'placeholder' => 'CC', 'id' => $key . '_cc']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label($key . '_bcc',
                        'BCC:') !!}
                        {!! Form::email('template_data[' . $key . '][bcc]', 
                        $value['bcc'], ['class' => 'form-control'
                        , 'placeholder' => 'BCC', 'id' => $key . '_bcc']); !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label($key . '_email_body',
                        __('lang_v1.email_body').':') !!}
                        {!! Form::textarea('template_data[' . $key . '][email_body]', 
                        $value['email_body'], ['class' => 'form-control ckeditor'
                        , 'placeholder' => __('lang_v1.email_body'), 'id' => $key . '_email_body', 'rows' => 6]); !!}
                    </div>
                </div>
                
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                {!! Form::checkbox('template_data[' . $key . '][auto_send]', 1, $value['auto_send'], ['class' => 'input-icheck']); !!} @lang('lang_v1.autosend_email')
                            </label>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('template_data[' . $key . '][auto_send_sms]', 1, $value['auto_send_sms'], ['class' => 'input-icheck']); !!} @lang('lang_v1.autosend_sms')
                            </label>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('template_data[' . $key . '][auto_send_wa_notif]', 1, $value['auto_send_wa_notif'], ['class' => 'input-icheck']); !!} @lang('lang_v1.auto_send_wa_notif')
                            </label>
                        </div>
                    </div>
                
                </div>
            </div>
        @endforeach
    </div>
</div>