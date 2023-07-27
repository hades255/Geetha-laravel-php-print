@inject('request', 'Illuminate\Http\Request')
@php
    $business_id = request()->session()->get('user.business_id');
    if(empty($business_id)){
      return redirect('/logout');
    }
    $top_belt_bg = DB::table('site_settings')->where('id', 1)->select('topBelt_background_color')->first()->topBelt_background_color;
@endphp

@php
$business_id = request()->session()->get('user.business_id');

$day_end =  DB::table('business')->where('id', $business_id)->select('day_end')->first();
if(!empty($day_end)){
  $day_end =  $day_end->day_end;
}else{
  $day_end =  0;
}
$day_end_enable =  DB::table('business')->where('id', $business_id)->select('day_end_enable')->first();
if(!empty( $day_end_enable)){
  $day_end_enable = $day_end_enable->day_end_enable;
}else{
  $day_end_enable = 0;
}
$tour_toggle =  DB::table('site_settings')->where('id', 1)->select('tour_toggle')->first()->tour_toggle;

$business_id = request()->session()->get('user.business_id');
$subscription = Modules\Superadmin\Entities\Subscription::active_subscription($business_id);

$pop_button_on_top_belt = \App\Utils\ModuleUtil::hasThePermissionInSubscription($business_id, 'pop_button_on_top_belt');

$cache_clear = 0;
$pacakge_details = [];
if(!empty($subscription)){
  $pacakge_details = $subscription->package_details;
  if(array_key_exists('cache_clear', $pacakge_details)){
      $cache_clear = $pacakge_details['cache_clear'];
  }
  if(array_key_exists('pos_sale',$pacakge_details)){
      $pos_sale= $pacakge_details['pos_sale'];
  }
}
if (auth()->user()->can('superadmin')) {
  $cache_clear = 1;
  $pos_sale = 1;
}

$help_desk_url = App\System::getProperty('helpdesk_system_url') ?? '#';
@endphp
<!-- Main Header -->

<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-4 col-sm-4 clearfix">
            <div class="nav-btn pull-left rounded" style="margin-left: -25px !important; background-color: #565656; padding: 3px" id="sidebar_collapser">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="pull-left">
                @include('superadmin::layouts.partials.active_subscription')
                @if($cache_clear)
                  <a href="{{action('BusinessController@clearCache')}}" class="btn  btn-sm btn-danger btn-flat mt-10 ml-10 clear_cache_btn" style= "margin-left:20px;">@lang('lang_v1.clear_cache')</a>
              @endif
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-8 col-sm-8 clearfix rounded " style="background-color: #2596be;height: 50px;">
            <ul class="notification-area pull-right">
                            
        @if(Module::has('Essentials'))
          @includeIf('essentials::layouts.partials.header_part')
        @endif
        
        <a target="_blank" href="{{$help_desk_url}}" title="@lang('lang_v1.back_to_superadmin')" type="button" class="btn btn-flat pull-left m-8 hidden-xs btn-sm mt-10 text-white" >
          <strong>@lang('superadmin::lang.help_desk')</strong>
      </a>
        @if(request()->session()->get('superadmin-logged-in') && !request()->session()->get('user.is_pump_operator'))
        <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@backToSuperadmin')}}" title="@lang('lang_v1.back_to_superadmin')" type="button" class="btn btn-flat pull-left m-8 text-white hidden-xs btn-sm mt-10" >
            <strong><i class="fa fa-arrow-left fa-lg" aria-hidden="true"></i></strong>
        </a>
        @endif
        @if(!request()->session()->get('user.is_pump_operator'))
        <a href="#" id="btnLock" title="@lang('lang_v1.lock_screen')" type="button" class="btn btn-flat pull-left m-8 hidden-xs btn-sm text-white mt-10 popover-default" data-placement="bottom">
          <strong><i class="fa fa-lock fa-lg" aria-hidden="true"></i></strong>
        </a>
        @endif

        <a href="#" id="btnCalculator" title="@lang('lang_v1.calculator')" type="button" class="btn  btn-flat text-white pull-left m-8 hidden-xs btn-sm mt-10 popover-default" tabindex="-1" data-toggle="click" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
            <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
        </a>
        
        @if($request->segment(1) == 'pos')
          <a href="#" type="button" id="register_details" title="{{ __('cash_register.register_details') }}" data-toggle="tooltip" data-placement="bottom" class="btn text-white btn-flat pull-left m-8 hidden-xs btn-sm mt-10 btn-modal" data-container=".register_details_modal" 
          data-href="{{ action('CashRegisterController@getRegisterDetails')}}">
            <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
          </a>
          <a href="#" type="button" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class="btn text-white btn-flat pull-left m-8 hidden-xs btn-sm mt-10 btn-modal" data-container=".close_register_modal" 
          data-href="{{ action('CashRegisterController@getCloseRegister')}}">
            <strong><i class="fa fa-window-close fa-lg"></i></strong>
          </a>
        @endif

        @if(!request()->session()->get('business.is_patient') && !request()->session()->get('business.is_hospital') && !request()->session()->get('business.is_pharmacy') && !request()->session()->get('business.is_laboratory'))
          @if($day_end_enable == 1)
            @can('day_end.view')
              <a href="{{action('BusinessController@dayEnd')}}" title="Day End" data-toggle="tooltip" data-placement="bottom" class="btn @if($day_end == 0)  @else text-white @endif btn-flat pull-left m-8 hidden-xs btn-sm mt-10">
                <strong><i class="fa fa-sun-o"></i> &nbsp;@if($day_end == 0) @lang('lang_v1.day_end')  @else @lang('lang_v1.day_ended') @endif</strong>
              </a>
            @endcan
          @endif
          @if(isset($pos_sale) && $pos_sale == 1)
              @can('sell.create')
                <a href="{{action('SellPosController@create')}}" title="POS" data-toggle="tooltip" data-placement="bottom" class="btn  btn-flat pull-left m-8 text-white hidden-xs btn-sm mt-10">
                  <strong><i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')</strong>
                </a>
              @endcan
          @endif
          @if($pop_button_on_top_belt ==1)
            @can('purchase.create')
              <a href="{{action('PurchasePosController@create')}}" title="Purchase" data-toggle="tooltip" data-placement="bottom" class="btn  btn-flat text-white pull-left m-8 hidden-xs btn-sm mt-10">
                <strong><i class="fa fa-th-large"></i> &nbsp; @lang('purchase.pop')</strong>
              </a>
            @endcan
          @endif
          @can('profit_loss_report.view')
            <a href="#" type="button" id="view_todays_profit" title="{{ __('home.todays_profit') }}" data-toggle="tooltip" data-placement="bottom" class="btn   btn-flat pull-left m-8 hidden-xs btn-sm mt-10">
              <strong><i class="fa fa-money fa-md text-white"></i></strong>
            </a>
          @endcan

          <!-- Help Button -->
          @if($tour_toggle == 1)
          @if(auth()->user()->hasRole('Admin#' . auth()->user()->business_id))
            <a href="#" type="button" id="start_tour" title="@lang('lang_v1.application_tour')" data-toggle="tooltip" data-placement="bottom" class="btn text-white  btn-flat pull-left m-8 hidden-xs btn-sm mt-10">
              <strong><i class="fa fa-question-circle fa-md" aria-hidden="true"></i></strong>
            </a>
          @endif
          @endif
        @endif
       

        <ul class="nav navbar-nav">
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle btn  btn-sm btn-danger btn-flat mt-10 ml-10 clear_cache_btn"  style="height: 30px; padding: 3px;" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              @php
                $profile_photo = auth()->user()->media;
              @endphp
              @if(!empty($profile_photo))
                <img src="{{$profile_photo->display_url}}" class="user-image" alt="User Image">
              @endif
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span>{{ substr(Auth::User()->first_name." ".Auth::User()->last_name,0,27) }}...</span>
            </a>
            <ul class="dropdown-menu rounded shadow-sm p-3 mb-5 bg-white rounded" style="margin-top: 15px;">
              <!-- The user image in the menu -->
              <li style="width: 100%; text-align : center;margin-left: 0px !important">
                <b>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</b>
              </li>
              <hr>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="">
                <a href="{{action('UserController@getProfile')}}" class=""><i class="fa fa-user"></i>&nbsp; @lang('lang_v1.profile')</a>
              </li>
              <li>
                  @if(auth()->user()->is_pump_operator)
                  <a href="{{action('Auth\PumpOperatorLoginController@logout')}}" class=""><i class="fa fa-sign-out"></i>&nbsp; @lang('lang_v1.sign_out')</a>
                  
                  @elseif(auth()->user()->is_property_user)
                  <a href="{{action('Auth\PropertyUserLoginController@logout')}}?id={{request()->session()->get('business.company_number')}}" class=""><i class="fa fa-sign-out"></i>&nbsp; @lang('lang_v1.sign_out')</a>
                  @else
                  <a href="{{action('Auth\LoginController@logout')}}?id={{request()->session()->get('business.company_number')}}" class=""><i class="fa fa-sign-out"></i>&nbsp; @lang('lang_v1.sign_out')</a>
                  @endif
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
        
        
        
        
        
        
        
        
                        </ul>
                    </div>
                </div>
            </div>