<link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<style>
    .label-info {
        background-color: #8F3A84;
    }
</style>
<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-3">
            <div class="form-group">
            	{!! Form::label('sms_settings_url', 'URL:') !!}
            	{!! Form::text('sms_settings[url]', $sms_settings['url'], ['class' => 'form-control','placeholder' => 'URL', 'id' => 'sms_settings_url']); !!}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('send_to_param_name', __('lang_v1.send_to_param_name') . ':') !!}
                {!! Form::text('sms_settings[send_to_param_name]', $sms_settings['send_to_param_name'], ['class' => 'form-control','placeholder' => __('lang_v1.send_to_param_name'), 'id' => 'send_to_param_name']); !!}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('msg_param_name', __('lang_v1.msg_param_name') . ':') !!}
                {!! Form::text('sms_settings[msg_param_name]', $sms_settings['msg_param_name'], ['class' => 'form-control','placeholder' => __('lang_v1.msg_param_name'), 'id' => 'msg_param_name']); !!}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('request_method', __('lang_v1.request_method') . ':') !!}
                {!! Form::select('sms_settings[request_method]', ['get' => 'GET', 'post' => 'POST'], $sms_settings['request_method'], ['class' => 'form-control', 'id' => 'request_method']); !!}
            </div>
        </div>
        
         <div class="col-xs-12">
            <div class="form-group">
                {!! Form::label('msg_phone_nos', __('lang_v1.msg_phone_nos') . ':') !!} <small>(__('lang_v1.separate_comma'))</small><br>
                {!! Form::text('sms_settings[msg_phone_nos]', !empty($sms_settings['msg_phone_nos']) ? $sms_settings['msg_phone_nos']: null, ['style' => 'width: 100%;','class' => 'form-control', 'id' => 'msg_phone_nos','data-role' => "tagsinput"]); !!}
            </div>
        </div>
        
        <div class="clearfix"></div>
        <hr>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key1', __('lang_v1.sms_settings_param_key', ['number' => 1]) . ':') !!}
                {!! Form::text('sms_settings[param_1]', $sms_settings['param_1'], ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 1]), 'id' => 'sms_settings_param_key1']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val1', __('lang_v1.sms_settings_param_val', ['number' => 1]) . ':') !!}
                {!! Form::text('sms_settings[param_val_1]', $sms_settings['param_val_1'], ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 1]), 'id' => 'sms_settings_param_val1' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key2', __('lang_v1.sms_settings_param_key', ['number' => 2]) . ':') !!}
                {!! Form::text('sms_settings[param_2]', $sms_settings['param_2'], ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 2]), 'id' => 'sms_settings_param_key2']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val2', __('lang_v1.sms_settings_param_val', ['number' => 2]) . ':') !!}
                {!! Form::text('sms_settings[param_val_2]', $sms_settings['param_val_2'], ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 2]), 'id' => 'sms_settings_param_val2' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key3', __('lang_v1.sms_settings_param_key', ['number' => 3]) . ':') !!}
                {!! Form::text('sms_settings[param_3]', $sms_settings['param_3'], ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 3]), 'id' => 'sms_settings_param_key3']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val3', __('lang_v1.sms_settings_param_val', ['number' => 3]) . ':') !!}
                {!! Form::text('sms_settings[param_val_3]', $sms_settings['param_val_3'], ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 3]), 'id' => 'sms_settings_param_val3' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key4', __('lang_v1.sms_settings_param_key', ['number' => 4]) . ':') !!}
                {!! Form::text('sms_settings[param_4]', $sms_settings['param_4'], ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 4]), 'id' => 'sms_settings_param_key4']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val4', __('lang_v1.sms_settings_param_val', ['number' => 4]) . ':') !!}
                {!! Form::text('sms_settings[param_val_4]', $sms_settings['param_val_4'], ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 4]), 'id' => 'sms_settings_param_val4' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key5', __('lang_v1.sms_settings_param_key', ['number' => 5]) . ':') !!}
                {!! Form::text('sms_settings[param_5]', $sms_settings['param_5'], ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 5]), 'id' => 'sms_settings_param_key5']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val5', __('lang_v1.sms_settings_param_val', ['number' => 5]) . ':') !!}
                {!! Form::text('sms_settings[param_val_5]', $sms_settings['param_val_5'], ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 5]), 'id' => 'sms_settings_param_val5' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key6', __('lang_v1.sms_settings_param_key', ['number' => 6]) . ':') !!}
                {!! Form::text('sms_settings[param_6]', !empty($sms_settings['param_6']) ? $sms_settings['param_6'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 6]), 'id' => 'sms_settings_param_key6']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val6', __('lang_v1.sms_settings_param_val', ['number' => 6]) . ':') !!}
                {!! Form::text('sms_settings[param_val_6]', !empty($sms_settings['param_val_6']) ? $sms_settings['param_val_6'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 6]), 'id' => 'sms_settings_param_val6' ]); !!}
            </div>
        </div>
         <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key7', __('lang_v1.sms_settings_param_key', ['number' => 7]) . ':') !!}
                {!! Form::text('sms_settings[param_7]', !empty($sms_settings['param_7']) ? $sms_settings['param_7'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 7]), 'id' => 'sms_settings_param_key7']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val7', __('lang_v1.sms_settings_param_val', ['number' => 7]) . ':') !!}
                {!! Form::text('sms_settings[param_val_7]', !empty($sms_settings['param_val_7']) ? $sms_settings['param_val_7'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 7]), 'id' => 'sms_settings_param_val7' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key8', __('lang_v1.sms_settings_param_key', ['number' => 8]) . ':') !!}
                {!! Form::text('sms_settings[param_8]', !empty($sms_settings['param_8']) ? $sms_settings['param_8'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 8]), 'id' => 'sms_settings_param_key8']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val8', __('lang_v1.sms_settings_param_val', ['number' => 8]) . ':') !!}
                {!! Form::text('sms_settings[param_val_8]', !empty($sms_settings['param_val_8']) ? $sms_settings['param_val_8'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 8]), 'id' => 'sms_settings_param_val8' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key9', __('lang_v1.sms_settings_param_key', ['number' => 9]) . ':') !!}
                {!! Form::text('sms_settings[param_9]', !empty($sms_settings['param_9']) ? $sms_settings['param_9'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 9]), 'id' => 'sms_settings_param_key9']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val9', __('lang_v1.sms_settings_param_val', ['number' => 9]) . ':') !!}
                {!! Form::text('sms_settings[param_val_9]', !empty($sms_settings['param_val_9']) ? $sms_settings['param_val_9'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 9]), 'id' => 'sms_settings_param_val9' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_key10', __('lang_v1.sms_settings_param_key', ['number' => 10]) . ':') !!}
                {!! Form::text('sms_settings[param_10]', !empty($sms_settings['param_10']) ? $sms_settings['param_10'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 10]), 'id' => 'sms_settings_param_key10']); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_param_val10', __('lang_v1.sms_settings_param_val', ['number' => 10]) . ':') !!}
                {!! Form::text('sms_settings[param_val_10]', !empty($sms_settings['param_val_10']) ? $sms_settings['param_val_10'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 10]), 'id' => 'sms_settings_param_val10' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_header_1', __('lang_v1.sms_settings_header_val', ['number' => 1]) . ':') !!}
                {!! Form::text('sms_settings[header_1]', !empty($sms_settings['header_1']) ? $sms_settings['header_1'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_header_val', ['number' => 1]), 'id' => 'sms_settings_header_1' ]); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_header_2', __('lang_v1.sms_settings_header_val', ['number' => 2]) . ':') !!}
                {!! Form::text('sms_settings[header_1]', !empty($sms_settings['header_2']) ? $sms_settings['header_2'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_header_val', ['number' => 2]), 'id' => 'sms_settings_header_2' ]); !!}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                {!! Form::label('sms_settings_header_3', __('lang_v1.sms_settings_header_val', ['number' => 3]) . ':') !!}
                {!! Form::text('sms_settings[header_3]', !empty($sms_settings['header_3']) ? $sms_settings['header_3'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_header_val', ['number' => 3]), 'id' => 'sms_settings_header_3' ]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-8 col-xs-12">
            <div class="form-group">
                <div class="input-group">
                    {!! Form::text('test_number', null, ['class' => 'form-control','placeholder' => __('lang_v1.test_number'), 'id' => 'test_number']); !!}
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success pull-right" id="test_sms_btn">@lang('lang_v1.test_sms_configuration')</button>
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>