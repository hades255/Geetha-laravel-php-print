@extends('layouts.auth-login')
@php
$settings = DB::table('site_settings')->where('id', 1)->select('*')->first();

$db_ads = DB::table('ad_page_slots')
            ->join('ad_pages', 'ad_page_slots.ad_page_id','ad_pages.id')
            ->leftJoin('ads', 'ads.ad_page_slot_id','ad_page_slots.id')
            ->select(['ads.content', 'ad_page_slots.*', 'ad_pages.name as ad_page_name','ad_page_slots.id as ad_page__slot_id'])
            ->orderBy('ad_pages.id', 'ASC')->get();

$ads = [];        
foreach ($db_ads as $ad) {
    $ads[$ad->ad_page_name . '_' . $ad->slot_no] = str_replace('/storage', '', $ad->content);
} 



$business_settings = $settings;
$show_message = json_decode($settings->show_messages);
if (!empty($show_message->lp_title)) {
if ($show_message->lp_title == 1) {
$login_page_title = $settings->login_page_title;
} else {
$login_page_title = '';
}
}
if (!empty($show_message->lp_description)) {
if ($show_message->lp_description == 1) {
$login_page_description = $settings->login_page_description;
} else {
$login_page_description = '';
}
} else {
$login_page_description = '';
}
if (!empty($show_message->lp_system_message)) {
if ($show_message->lp_system_message == 1) {
$login_page_general_message = $settings->login_page_general_message;
} else {
$login_page_general_message = '';
}
} else {
$login_page_general_message = '';
}
$bg_showing_type = $settings->background_showing_type;
$lang_btn = App\System::getProperty('enable_lang_btn_login_page');
$register_btn = App\System::getProperty('enable_register_btn_login_page');
$enable_agent_register_btn_login_page = App\System::getProperty('enable_agent_register_btn_login_page');
$visitor_register_btn = App\System::getProperty('enable_visitor_register_btn_login_page');
$pricing_btn = App\System::getProperty('enable_pricing_btn_login_page');
$enable_admin_login = App\System::getProperty('enable_admin_login');
$enable_member_login = App\System::getProperty('enable_member_login');
$enable_visitor_login = App\System::getProperty('enable_visitor_login');
$enable_customer_login = App\System::getProperty('enable_customer_login');


$util = new \App\Utils\BusinessUtil();

$show_referrals_in_register_page = json_decode(App\System::getProperty('show_referrals_in_register_page'),true);

$show_give_away_gift_in_register_page = json_decode(App\System::getProperty('show_give_away_gift_in_register_page'),true);

$currencies = $util->allCurrencies();

$timezone_list = $util->allTimeZones();
$months = [];
$accounting_methods = $util->allAccountingMethods();
$package_id = 0;
$agent_referral_code = 0;
$districts = App\Districts::get();
$towns = [];


$enable_agent_login = App\System::getProperty('enable_agent_login');
$enable_employee_login = App\System::getProperty('enable_employee_login');
$enable_member_register_btn = App\System::getProperty('enable_member_register_btn_login_page');
$enable_patient_register_btn = App\System::getProperty('enable_patient_register_btn_login_page');
$enable_individual_register_btn = App\System::getProperty('enable_individual_register_btn_login_page');
$enable_welcome_msg = App\System::getProperty('enable_welcome_msg');
$business_or_entity = App\System::getProperty('business_or_entity');
$enable_login_banner_image = App\System::getProperty('enable_login_banner_image');
$login_banner_image = App\System::getProperty('login_banner_image');
$enable_login_banner_html = App\System::getProperty('enable_login_banner_html');

$login_banner_html = App\System::getProperty('login_banner_html');
$array_values = [$lang_btn, $register_btn, $pricing_btn];
if ($lang_btn == 1 || $register_btn == 1 || $pricing_btn == 1) {
$frequency = array_count_values($array_values)[1];
} else {
$frequency = 0;
}
$margin = 0;
if ($frequency == 3) {
$margin = -20;
}
if ($frequency == 2) {
$margin = -3;
}
if ($frequency == 1) {
$margin = 11;
}
$user_types = [];
$regis_single = true;
if ($visitor_register_btn) {
$user_types['visitor_register'] = __('superadmin::lang.visitor_register');
 if($regis_single){
    $regis_single = 'show_modal';
 }else{
    $regis_single = 'visitor_register';
 }

}
if ($enable_agent_register_btn_login_page) {
$user_types['agent_register'] = __('superadmin::lang.agent_register');
if($regis_single){
    $regis_single = 'show_modal';
 }else{
    $regis_single = 'agent_register';
 }
}
if ($register_btn) {
$user_types['company_register'] = __('superadmin::lang.company_register');
if($regis_single){
    $regis_single = 'show_modal';
 }else{
    $regis_single = 'company_register';
 }
}
if ($enable_customer_login) {
$user_types['customer_register'] = __('superadmin::lang.customer_register');
if($regis_single){
    $regis_single = 'show_modal';
 }else{
    $regis_single = 'customer_register';
 }
}
if ($enable_member_register_btn) {
$user_types['memeber_regsiter'] = __('superadmin::lang.member_register');
if($regis_single){
    $regis_single = 'show_modal';
 }else{
    $regis_single = 'memeber_regsiter';
 }
}
if ($enable_patient_register_btn) {
$user_types['patient_register'] = __('superadmin::lang.my_health');
if($regis_single){
    $regis_single = 'show_modal';
 }else{
    $regis_single = 'patient_register';
 }
}
 

$site_setting = App\SiteSettings::where('id', 1)->select('login_vehicle_registration')->first();
$login_vehicle_registration = $site_setting->login_vehicle_registration??0;
if ($login_vehicle_registration) {
    if($regis_single){
        $regis_single = 'show_modal';
    }else{
        $regis_single = 'vehicle_register';
    }
    $user_types['vehicle_register'] = 'Register Your Vehicle';
}


$business_categories = App\BusinessCategory::pluck('category_name', 'id');

@endphp


@section('content')
@inject('request', 'Illuminate\Http\Request')
<style>
    .remove-border {
        border: none !important;
    }
</style>
        <div class="grid-container d-grid">

            <div class="grid-col-50 d-grid d-grid-gap-20" style="padding-bottom: 2px;">
                <div class="d-grid">
                    <div class="left-logo">
                        @if(!empty($business->background_showing_type) &&
                        !empty($business->background_showing_type)
                        && $business->background_showing_type == 'background_image_and_logo')
                        <img src="{{url('public/uploads/business_logos/' . $business->logo)}}"
                            class="img-rounded" alt="Logo" style="display: block;
                        max-width: 100%;
                        width: @if(!empty($settings->logingLogo_width)) {{$settings->logingLogo_width}}px @else 300px @endif;
                        height: @if(!empty($settings->logingLogo_height)) {{$settings->logingLogo_height}}px @else auto @endif;;
                        margin: auto;">
                            @elseif(!empty($settings->uploadFileLLogo) && file_exists(public_path().
                            str_replace('public', '', $settings->uploadFileLLogo)))
                            <img src="{{url($settings->uploadFileLLogo)}}" class="img-rounded" alt="Logo" style="display: block;
                        max-width: 100%;
                        width: @if(!empty($settings->logingLogo_width)) {{$settings->logingLogo_width}}px @else 300px @endif;
                        height: @if(!empty($settings->logingLogo_height)) {{$settings->logingLogo_height}}px @else auto @endif;;
                        margin:auto;">
                            @else
                        {{ config('app.name', 'ultimatePOS') }}
                        @endif
                    </div>
                </div>
                
                <div class="d-grid-gap-12 d-grid right-si">
                    <div class="d-grid">
                        <div class=" border_shadow  text-center leaderboard w-auto-7 g-center  remove-border "  >
                                @if(!empty($ads['Landing page_1']) && file_exists(asset('uploads/' . $ads['Landing page_1'])))
                                   <div class="landing"> 
                                        @if(!empty($ads['Landing page_1'])) 
                                            <img src="{{ asset('uploads/' . $ads['Landing page_1']) }}" class="landing" id="landing_slot_one" />
                                        @else
                                            <h1> </h1>
                                        @endif
                                   </div>
                               @endif
                               @if(!empty($ads['Sign in page_1']) && file_exists(asset('uploads/' . $ads['Sign in page_1'])))
                               <div class="signin" style="display:none;"> 
                                   @if(!empty($ads['Sign in page_1'])) 
                                        <img src="{{ asset('uploads/' . $ads['Sign in page_1']) }}" class="signin" id="signin_slot_one" style="display:none;"/>
                                   @else 
                                        <h1> </h1>
                                   @endif
                               </div>
                               @endif
                                <!--<h1>Slot_1</h1>-->
                        </div>
                    </div>
                    <div class="d-grid iner-grid-col-50 top_action_row" style="gap: 10px;overflow: hidden;">
                        <div class="border_shadow  text-center  medium-ret  remove-border">
                            @if(!empty($ads['Landing page_2']) && file_exists(asset('uploads/' . $ads['Landing page_2'])))
                            <div class="landing">
                                @if(!empty($ads['Landing page_2']))
                                    <img src="{{ asset('uploads/' . $ads['Landing page_2']) }}" class="landing" id="landing_slot_two" />
                                @else 
                                    <h1> </h1>
                                @endif
                            </div>
                            @endif
                            
                            @if(!empty($ads['Sign in page_2']) && file_exists(asset('uploads/' . $ads['Sign in page_2'])))
                            <div class="signin" style="display:none;">
                                @if(!empty($ads['Sign in page_2']))
                                    <img src="{{ asset('uploads/' . $ads['Sign in page_2']) }}" class="signin" id="signin_slot_two" style="display:none;"/>
                                @else 
                                    <h1> </h1>
                                @endif
                            </div>
                            @endif
                            <!--<h1> </h1>-->
                        </div>
                        @if($lang_btn)
                        <div class="text-center bg_grey " style="padding: 10px 10px 0 10px">
                            <div class="grid-3" style="grid-template-columns: repeat({{count(config('constants.langs'))}}, minmax(100px, 1fr));overflow-x: auto;overflow-y: hidden;">
                                @foreach(config('constants.langs') as $key => $val)
                                  @if(!empty($val))
                                    <a href="{{ route('login') }}?lang={{$key}}" class="">
                                        <div class="grid-lang-card ">
                                            <div style="height:20px" class="@if( (empty(request()->lang) && config('app.locale')== $key) || request()->lang == $key) active @endif"></div>
                                            <div class="">{{$val['short_name']}}</div>
                                        </div>
                                    </a>
                                  @endif
                                @endforeach

                            </div>
                        </div>
                        @else
                        <div class="border_shadow  text-center  medium-ret  remove-border">
                            @if(!empty($ads['Landing page_5']) && file_exists(asset('uploads/' . $ads['Landing page_5'])))
                            <div class="landing">
                                @if(!empty($ads['Landing page_5']))
                                    <img src="{{ asset('uploads/' . $ads['Landing page_5']) }}" class="landing" id="landing_slot_five" />
                                @else 
                                    <h1> </h1>
                                @endif
                            </div>
                            @endif
                            @if(!empty($ads['Sign in page_5']) && file_exists(asset('uploads/' . $ads['Sign in page_5'])))
                            <div class="signin" style="display:none;">
                                @if(!empty($ads['Sign in page_5']))
                                    <img src="{{ asset('uploads/' . $ads['Sign in page_5']) }}" class="signin" id="signin_slot_five" style="display:none;"/>
                                @else 
                                    <h1> </h1>
                                @endif
                            </div>
                            @endif
                            <!--<h1> </h1>-->
                        </div>
                        @endif
                    </div>
                    <div class="d-grid">
                        <div class="leaderboard w-auto-7 g-center border_shadow  text-center remove-border">
                            @if(!empty($ads['Landing page_3']) && file_exists(asset('uploads/' . $ads['Landing page_3'])))
                            <div class="landing">
                                @if(!empty($ads['Landing page_3']))
                                <img src="{{ asset('uploads/' . $ads['Landing page_3']) }}" class="landing" id="landing_slot_three" />
                                @else 
                                <h1> </h1>
                                @endif
                            </div>
                            @endif
                            @if(!empty($ads['Sign in page_3']) && file_exists(asset('uploads/' . $ads['Sign in page_3'])))
                            <div class="signin" style="display:none;">
                                @if(!empty($ads['Sign in page_3']))
                                    <img src="{{ asset('uploads/' . $ads['Sign in page_3']) }}" class="signin" id="signin_slot_three" style="display:none;"/>
                                @else
                                    <h1> </h1>
                                @endif
                            </div>
                            @endif
                                <!--<h1> </h1>-->
                        </div>
                    </div>
                    <div class="d-grid" id='action-row' style="gap: 10px;">
                        <div class="col-12   text-center  " >
                            <button class="btn btn-lg btn-success action-button pull-left mobile_block" data-action='login'> @lang('lang_v1.login')</button>

                            <!------------------------------------------------------ 6021-1 Repair status button --------------------------------------->

                            @if(App\System::getProperty('enable_repair_btn_login_page'))
                            <button style="margin: 0 10px;" id="repair_status_button" class="btn btn-lg btn-primary mobile_block"> @lang('lang_v1.repair_status')</button>
                            @endif  

                            <!------------------------------------------------------ 6021-1 End Repair status button --------------------------------------->
                            <!-- action-button -->
                            @if($pricing_btn)
                            <a class="btn btn-lg btn-success  mobile_block" href="{{ action('\Modules\Superadmin\Http\Controllers\PricingController@index') }}">@lang('superadmin::lang.pricing')</a>                                   
                            @endif
                            @if($enable_individual_register_btn)
                            <button class="btn btn-lg btn-info action-button pull-right mobile_block"   data-action="{{$regis_single}}"  >{{ __('business.register') }}</button>
                            @endif
                        </div>
                    </div>
                    
                    <div class="d-grid hidden" id='vehicle_register'>
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('vehicle.store') }}">
                                {!! Form::token(); !!}   
                                {{-- this route define in web.php --}}
                                @include('petro::vehicle.register')
                                {!! Form::close() !!}
                            </form>
                        </div>
                    </div>

                    <div class="d-grid hidden" id="visitor_register_modal"  >

                        {!! Form::open(['url' => route('business.postVisitorRegister'), 'method' => 'post',
                        'id' => 'visitor_register_form','files' => true ]) !!}
                            <p class="form-header">@lang('business.register_and_get_started_in_minutes')</p>
                            @include('business.partials.register_form_visitor')
                            <p></p>
                            <hr>
                            <div class="clearfix"></div>
                            <div>
                                <button type="submit" id="visitor_form_btn" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            {!! Form::close() !!}
                    </div>
                    

                    <!-- Modal -->
                    <div class="d-grid hidden" id="register_modal" role="dialog">

                        <p class="form-header">@lang('business.register_and_get_started_in_minutes')</p>
                        {!! Form::open(['url' => route('business.postRegister'), 'method' => 'post',
                        'id' => 'business_register_form','files' => true ]) !!}
                        @include('business.partials.register_form')
                        {!! Form::hidden('package_id', $package_id); !!}
                        {!! Form::close() !!}
            
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="member_register_modal" role="dialog">

                        <p class="form-header">@lang('business.member_registration')</p>
                        {!! Form::open(['url' => route('business.member_register'), 'method' => 'post','id' => 'member_register_form','files' => true ]) !!}
                        @include('business.partials.member_register')
                        {!! Form::close() !!}
                               
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="patient_register_modal" >

                                    <h2 class="form-header">@lang('business.my_health_register')</h2>
                                    {!! Form::open(['url' => route('business.postPatientRegister'), 'method' => 'post',
                                    'id' => 'patient_register_form','files' => true ]) !!}
                                    @include('business.partials.register_form_patient')
                                    {!! Form::hidden('package_id', $package_id, ['class' => 'package_id']); !!}
                                    {!! Form::close() !!}
                     </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="agent_register_modal" >

                                    <h2 class="form-header">@lang('superadmin::lang.agent_registration')</h2>
                                    {!! Form::open(['url' => route('business.postAgentRegister'), 'method' => 'post',
                                    'id' => 'agent_register_form','files' => true ]) !!}
                                    @include('business.partials.register_form_agent')
                                    
                                    {!! Form::hidden('package_id', $package_id, ['class' => 'package_id']); !!}
                                    {!! Form::close() !!}

                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="self_registration_modal" >
     
                                    <p class="form-header">@lang('lang_v1.self_registration')</p>
                                    {{-- this route define in web.php --}}
                                    {!! Form::open(['url' => '/visitor/register', 'method' => 'post',
                                    'id' => 'self_registration_form','files' => true ]) !!}
                                    @include('visitor::visitor_registration.self_registration')
                                    {!! Form::close() !!}
                 
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="vehical_registration_modal" >

                                    <p class="form-header">@lang('lang_v1.self_registration')</p>
                                    {{-- this route define in web.php --}}
                                    {!! Form::open(['url' => '/visitor/register', 'method' => 'post',
                                    'id' => 'self_registration_form','files' => true ]) !!}
                                    @include('visitor::visitor_registration.self_registration')
                                    {!! Form::close() !!}
                               
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="customer_register_modal" >

                                    <p class="form-header">@lang('business.register_and_get_started_in_minutes')</p>
                                    {!! Form::open(['url' => route('business.customer_register'), 'method' => 'post',
                                    'id' => 'customer_register_form','files' => true ]) !!}
                                    @include('business.partials.customer_register')
                                    {!! Form::hidden('package_id', $package_id); !!}
                                    {!! Form::close() !!}
                               
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="password_reset_1" >
                        <form method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}"
                                style="text-align:center;">
                                <label for="">Please enter the Email</label>
                                <input id="reset_1_email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required autofocus placeholder="@lang('lang_v1.email_address')">
                                <span class="fa fa-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    @lang('lang_v1.send_password_reset_link')
                                </button>
                            </div>
                        </form>                                   
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="password_reset_3" >

                        <form method="POST" action="{{ route('member_password.email') }}">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}"
                                style="text-align:center;">
                                <label for="">Please enter the Email</label>
                                <input id="reset_3_email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required autofocus placeholder="@lang('lang_v1.email_address')">
                                <span class="fa fa-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    @lang('lang_v1.send_password_reset_link')
                                </button>
                            </div>
                        </form>
             
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="password_reset_4" >
                        
                        <form method="POST" action="{{ route('employee_password.email') }}">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}"
                                style="text-align:center;">
                                <label for="">Please enter the Email</label>
                                <input id="reset_4_email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required autofocus placeholder="@lang('lang_v1.email_address')">
                                <span class="fa fa-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    @lang('lang_v1.send_password_reset_link')
                                </button>
                            </div>
                        </form>
           
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="5" >

                        <form method="POST" action="{{ route('customer_password.email') }}">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}"
                                style="text-align:center;">
                                <label for="">Please enter the Email</label>
                                <input id="reset_5_email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required autofocus placeholder="@lang('lang_v1.email_address')">
                                <span class="fa fa-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    @lang('lang_v1.send_password_reset_link')
                                </button>
                            </div>
                        </form>
                                    
                    </div>
                    <!-- Modal -->
                    <div class="d-grid hidden" id="password_reset_5" tabindex="-1" >
                        <form method="POST" action="{{ route('customer_password.email') }}">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}"
                                style="text-align:center;">
                                <label for="">Please enter the Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required autofocus placeholder="@lang('lang_v1.email_address')">
                                <span class="fa fa-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    @lang('lang_v1.send_password_reset_link')
                                </button>
                            </div>
                        </form>
                                    
                    </div>
                    <div class="d-grid hidden"  tabindex="-1" role="dialog" id="register_success_modal">

                        <i class="fa fa-check fa-lg"
                            style="font-size: 50px; margin-top: 20px; border: 1px solid #4BB543; color: #4BB543; padding:15px 10px 15px 10px; border-radius: 50%;"></i>
                        <h2>{!!session('register_success.title')!!}</h2>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            {!!session('register_success.msg')!!}
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              
                    </div>   
                </div>
            </div>
            
            <div class="grid-col-50 d-grid d-grid-gap-20">
                <div class="d-grid" >
                    <div class="col-12 border_shadow  text-center leaderboard w-auto-7 g-center slot_6  remove-border">
                        @if(!empty($ads['Landing page_6']) && file_exists(asset('uploads/' . $ads['Landing page_6'])))
                         <div class="landing">@if(!empty($ads['Landing page_6'])) <img src="{{ asset('uploads/' . $ads['Landing page_6']) }}" class="landing" id="landing_slot_six" />@else <h1> </h1>@endif</div>
                         @endif
                         @if(!empty($ads['Sign in page_6']) && file_exists(asset('uploads/' . $ads['Sign in page_6'])))
                         <div class="signin" style="display:none;">@if(!empty($ads['Sign in page_6'])) <img src="{{ asset('uploads/' . $ads['Sign in page_6']) }}" class="signin" id="signin_slot_six" style="display:none;"/>@else <h1> </h1>@endif</div>
                         
                         @endif
                        <!--<h1>Slot 6</h1>-->
                    </div>
                </div>
                <div class="d-grid" >
                    <div class="col-12 border_shadow  text-center leaderboard w-auto-7 g-center remove-border" >
                        @if(!empty($ads['Landing page_4']) && file_exists(asset('uploads/' . $ads['Landing page_4'])))
                        <div class="landing">@if(!empty($ads['Landing page_4'])) <img src="{{ asset('uploads/' . $ads['Landing page_4']) }}" class="landing" id="landing_slot_four" />@else <h1> </h1>@endif</div>
                        @endif
                        @if(!empty($ads['Sign in page_4']) && file_exists(asset('uploads/' . $ads['Sign in page_4'])))
                        <div class="signin" style="display:none;">@if(!empty($ads['Sign in page_4'])) <img src="{{ asset('uploads/' . $ads['Sign in page_4']) }}" class="signin" id="signin_slot_four" style="display:none;"/>  @else <h1> </h1>@endif</div>
                        <!--<h1> </h1>-->
                        @endif
                    </div>
                </div>
            </div>
            <div class="grid-col-50 d-grid d-grid-gap-20">
                <div class="d-grid" >
 
                </div>
                <div class="d-grid" >
                   
                    <div class="d-grid">
                        <div class="col-12  text-center  " >
                            <p>{{$settings->login_page_footer}}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

<div class="modal fade" id="check_register_type_modal" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    {!! Form::label('check_register_type', 'Plesae select the register type', ['style' => 'color: black
                    !important;']) !!}
                    {!! Form::select('check_register_type', $user_types, null, ['class' => 'form-control',
                    'style' => 'width: 100%;', 'id' => 'check_register_type', 'placeholder' =>
                    __('lang_v1.please_select')]) !!}
                </div>
                <div class="col-md-2"></div>
            </div>
            <hr>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------ 6029-1 Repair status modal --------------------------------------->

<div class="modal fade" id="repair_status_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="exampleModalLongTitle">{{__('repair::lang.repair_status')}}</span>
        <span type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
                    </span>
      </div>
      <div class="modal-body bg-info text-white ">
      <form method="POST" action="{{action('\Modules\Repair\Http\Controllers\CustomerRepairStatusController@postRepairStatus')}}" id="check_repair_status">
        <div class="form-group">
            @php
                $search_options = [
                    'job_sheet_no' => __('repair::lang.job_sheet_no'), 
                    'invoice_no' => __('sale.invoice_no')
                ];

                $placeholder = __('repair::lang.job_sheet_or_invoice_no');

                if (config('repair.enable_repair_check_using_mobile_num')) {
                    $search_options['mobile_num'] = __('lang_v1.mobile_number');
                    $placeholder .= ' / '.__('lang_v1.mobile_number');
                }
            @endphp
            <div class="multi-input">
                {!! Form::select('search_type', 
                $search_options, 
                null, 
                ['class' => 'form-control width-60 pull-left']); !!}

                {!! Form::text('search_number', null, ['class' => 'form-control width-40 pull-left', 'required', 'placeholder' => $placeholder]); !!}
            </div>
        </div><br><br>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fas fa-microchip"></i></div>
                <input type="text" name="serial_no" class="form-control" id="repair_serial_no" placeholder="@lang('repair::lang.serial_no')">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-login btn btn-primary btn-flat ladda-button">
                @lang('lang_v1.search')
            </button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="repair_status_details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="exampleModalLongTitle">{{__('repair::lang.repair_status')}}</span>
        <span type="button" class="close" id="repair_details_back_button">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body  bg-info text-white ">
         <div class="row repair_status_details"></div>
      </div>
    </div>
  </div>
</div>

<!------------------------------------------------------ 6029-1 End Repair status modal --------------------------------------->


@stop
@section('javascript')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.action-button').on('click',function(){
            $(this).data('action');
            if($(this).data('action') == 'login'){
                $('#register-row').addClass('hidden')
                $('#login-row').removeClass('hidden')
                $('#action-row').addClass('hidden')
                $('.top_action_row').addClass('hidden')
                
                $('.landing').css('display', 'none');
                $('.signin').css('display', 'block');
                
            }else if($(this).data('action') == 'show_modal'){
                $('#check_register_type_modal').modal('show')
            }else {
                $('#'+$(this).data('action')).removeClass('hidden')
                $('#action-row').addClass('hidden')
            }

        })
        $('.login-tab-content div').eq(0).addClass('active');
        $('.login-tab li').eq(0).addClass('active');

        $('#mobile').on('input', function (e) {

            this.value = this.value.replace(/\D/g, '');
        });

        //------------------------ 6029-1 Repair status modal jquery ---------------------------//

        $(document).on('click', '#repair_status_button', function () {
            var url = $(this).data('href');
            $('#repair_status_modal').modal('show');
        });

        $(document).on('click', '#repair_details_back_button', function () {
            $("#repair_status_details_modal").modal('hide')
            $('#repair_status_modal').modal('show');
        });


        $(document).on('submit', 'form#check_repair_status', function(e) {
			console.log(e);
	        e.preventDefault();
		    var data = $('form#check_repair_status').serialize();
		    var url = $('form#check_repair_status').attr('action');
		    $.ajax({
		        method: 'POST',
		        url: url,
		        dataType: 'json',
		        data: data,
		        success: function(result) {
		            if (result.success) {
                        $('#repair_status_modal').modal('hide');
                        $details_modal = $("#repair_status_details_modal")
		            	$details_modal.find('.repair_status_details').html(result.repair_html);
                        $details_modal.modal('show')
		                toastr.success(result.msg);
		            } else {
		                toastr.error(result.msg);
		            }
		        }
		    });
	   	});

        //------------------------ End  6029-1 Repair status modal jquery ------------------------//

        $(document).on('change', '#check_register_type',function(){
            register_type = $(this).val();
            if(register_type == 'visitor_register'){
                $('#visitor_register_modal').removeClass('hidden');
            }
            if(register_type == 'customer_register'){
                $('#customer_register_modal').removeClass('hidden');
            }
            if(register_type == 'memeber_regsiter'){
                $('#member_register_modal').removeClass('hidden');
            }
            if(register_type == 'patient_register'){
                $('#patient_register_modal').removeClass('hidden');
            }
            if(register_type == 'company_register'){
                $('#register_modal').removeClass('hidden');
            }
            if(register_type == 'agent_register'){
                $('#agent_register_modal').removeClass('hidden');
            }
            if(register_type == 'vehicle_register'){
                $('#register-row').removeClass('hidden')
            }
            $('#check_register_type_modal').modal('hide');
            // $('#action-row').addClass('hidden')

        })
    })
</script>
@endsection