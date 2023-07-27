<!DOCTYPE html>
<html>
@php
$settings = DB::table('site_settings')->where('id', 1)->select('*')->first();
$show_message = json_decode($settings->show_messages);

if(!empty($show_message->lp_title)){
if($show_message->lp_title == 1) {
$login_page_title = $settings->login_page_title;
}else{
$login_page_title = '';
}
}else{
$login_page_title = '';
}

if(!empty($show_message->lp_text)){
if($show_message->lp_text == 1) {
$login_page_footer = $settings->login_page_footer;
}else{
$login_page_footer = '';
}
}else{
$login_page_footer = '';
}


if(!empty($show_message->lp_system_expired)){
if($show_message->lp_system_expired == 1) {
$system_expired_message = $settings->system_expired_message;
}else{
$system_expired_message = '';
}
}else{
$system_expired_message = '';
}
$login_background_color = $settings->login_background_color;

if(!empty($business->background_showing_type) && !empty($business->background_showing_type)){
    $background_style = 'background-image: url('.$business->background_image.'); background-repeat: no-repeat;background-size: cover;' ;
}else{
    if(!empty($settings->uploadFileLBackground) && ($bg_showing_type == 1 || $bg_showing_type == 3)){
        $background_style = 'background-image: url('.$settings->uploadFileLBackground.'); background-repeat: no-repeat;background-size: cover;' ;
    }
    else{
        $background_style = 'background:'.$login_background_color.';background-size: cover;';
    }
}

$system_settings = DB::table('system')->where('key', 'main_page_refresh_interval_minute')->first();
$refresh_time = ($system_settings? $system_settings->value:0) * 60; 
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    @auth
	@else
    <meta http-equiv="refresh" content="{{$refresh_time}}" />
    @endauth
    
     @include('layouts.partials.adsense')
    <title>{{$login_page_title}}</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    <link rel="shortcut icon" type="image/x-icon" href="{{url($settings->uploadFileFicon)}}" />
    
    <link rel="stylesheet" href="{{ asset('plugins/jquery.steps/jquery.steps.css?v=' . $asset_v) }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/iCheck/square/blue.css?v='.$asset_v) }}">
        
    @include('layouts.partials.css')
    <link href="{{asset('css/login.css')}}" rel="stylesheet" type="text/css" />



</head>

<body style="{{$background_style}}">
    @if (session('status'))
    <input type="hidden" id="status_span" data-status="{{ session('status.success') }}"
        data-msg="{{ session('status.msg') }}">
    @endif
    @yield('content')
    @if(!empty($show_message->lp_text))
    @if($show_message->lp_text == 1)
    <div class="login_footer">

        <div class="copy"></div>

        <div class="copy">{{$login_page_footer}}</div>

    </div>
    @endif
    @endif
    <script src="{{ asset('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js?v=' . $asset_v) }}"></script>

    @include('layouts.partials.javascripts')
    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>

    @yield('javascript')

</body>

</html>