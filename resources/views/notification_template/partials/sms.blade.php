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
                
                <div class="form-group col-md-6">
                    {!! Form::label($key . '_sms_body',
                    __('lang_v1.sms_body').':') !!}
                    {!! Form::textarea('template_data[' . $key . '][sms_body]', 
                    $value['sms_body'], ['class' => 'form-control'
                    , 'placeholder' => __('lang_v1.sms_body'), 'id' => $key . '_sms_body', 'rows' => 6]); !!}
                </div>
                <div class="form-group col-md-6">
                        {!! Form::label($key . '_whatsapp_text',
                        __('lang_v1.whatsapp_text').':') !!}
                        {!! Form::textarea('template_data[' . $key . '][whatsapp_text]', 
                        $value['whatsapp_text'], ['class' => 'form-control'
                        , 'placeholder' => __('lang_v1.whatsapp_text'), 'id' => $key . '_whatsapp_text', 'rows' => 6]); !!}
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