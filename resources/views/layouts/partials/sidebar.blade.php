@inject('request', 'Illuminate\Http\Request')
@php
	$sidebar_setting = App\SiteSettings::where('id', 1)->select('ls_side_menu_bg_color', 'ls_side_menu_font_color', 'sub_module_color', 'sub_module_bg_color')->first();

	$module_array['disable_all_other_module_vr'] = 0;
	$module_array['enable_petro_module'] = 0;
	$module_array['enable_petro_dashboard'] = 0;
	$module_array['enable_petro_task_management'] = 0;
	$module_array['enable_petro_pump_dashboard'] = 0;
	$module_array['enable_petro_pumper_management'] = 0;
	$module_array['enable_petro_daily_collection'] = 0;
	$module_array['enable_petro_settlement'] = 0;
	$module_array['enable_petro_list_settlement'] = 0;
	$module_array['enable_petro_dip_management'] = 0;
	$module_array['enable_sale_cmsn_agent'] = 0;
	$module_array['pump_operator_dashboard'] = 0;
	$module_array['enable_crm'] = 0;
	$module_array['mf_module'] = 0;
	$module_array['hr_module'] = 0;
	$module_array['loan_module'] = 0;
	$module_array['employee'] = 0;
	$module_array['teminated'] = 0;
	$module_array['award'] = 0;
	$module_array['leave_request'] = 0;
	$module_array['attendance'] = 0;
	$module_array['import_attendance'] = 0;
	$module_array['late_and_over_time'] = 0;
	$module_array['payroll'] = 0;
	$module_array['salary_details'] = 0;
	$module_array['basic_salary'] = 0;
	$module_array['payroll_payments'] = 0;
	$module_array['hr_reports'] = 0;
	$module_array['notice_board'] = 0;
	$module_array['hr_settings'] = 0;
	$module_array['department'] = 0;
	$module_array['jobtitle'] = 0;
	$module_array['jobcategory'] = 0;
	$module_array['workingdays'] = 0;
	$module_array['workshift'] = 0;
	$module_array['holidays'] = 0;
	$module_array['leave_type'] = 0;
	$module_array['salary_grade'] = 0;
	$module_array['employment_status'] = 0;
	$module_array['salary_component'] = 0;
	$module_array['hr_prefix'] = 0;
	$module_array['hr_tax'] = 0;
	$module_array['religion'] = 0;
	$module_array['hr_setting_page'] = 0;
	$module_array['enable_sms'] = 0;
	$module_array['access_account'] = 0;
	$module_array['enable_booking'] = 0;
	$module_array['customer_order_own_customer'] = 0;
	$module_array['customer_settings'] = 0;
	$module_array['customer_order_general_customer'] = 0;
	$module_array['mpcs_module'] = 0;
	$module_array['fleet_module'] = 0;
	$module_array['ezyboat_module'] = 0;
	$module_array['merge_sub_category'] = 0;
	$module_array['backup_module'] = 0;
	$module_array['banking_module'] = 0;
	$module_array['products'] = 0;
	$module_array['purchase'] = 0;
	$module_array['stock_transfer'] = 0;
	$module_array['service_staff'] = 0;
	$module_array['enable_subscription'] = 0;
	$module_array['add_sale'] = 0;
	$module_array['stock_adjustment'] = 0;
	$module_array['tables'] = 0;
	$module_array['type_of_service'] = 0;
	$module_array['pos_sale'] = 0;
	$module_array['expenses'] = 0;
	$module_array['modifiers'] = 0;
	$module_array['kitchen'] = 0;
	$module_array['orders'] = 0;
	$module_array['enable_cheque_writing'] = 0;
	$module_array['issue_customer_bill'] = 0;
	$module_array['tasks_management'] = 0;
	$module_array['notes_page'] = 0;
	$module_array['tasks_page'] = 0;
	$module_array['reminder_page'] = 0;
	$module_array['member_registration'] = 0;
	$module_array['visitors_registration_module'] = 0;
	$module_array['visitors'] = 0;
	$module_array['visitors_registration'] = 0;
	$module_array['visitors_registration_setting'] = 0;
	$module_array['visitors_district'] = 0;
	$module_array['visitors_town'] = 0;
	$module_array['home_dashboard'] = 0;
	$module_array['contact_module'] = 0;
	$module_array['stock_taking_page'] = 0;
	$module_array['contact_supplier'] = 0;
	$module_array['contact_customer'] = 0;
	$module_array['contact_group_customer'] = 0;
	$module_array['import_contact'] = 0;
	$module_array['customer_reference'] = 0;
	$module_array['customer_statement'] = 0;
	$module_array['customer_payment'] = 0;
	$module_array['outstanding_received'] = 0;
	$module_array['issue_payment_detail'] = 0;
	$module_array['property_module'] = 0;
	$module_array['ran_module'] = 0;
	$module_array['report_module'] = 0;
	$module_array['product_report'] = 0;
	$module_array['payment_status_report'] = 0;
	$module_array['verification_report'] = 0;
	$module_array['activity_report'] = 0;
	$module_array['contact_report'] = 0;
	$module_array['trending_product'] = 0;
	$module_array['user_activity'] = 0;
	$module_array['report_verification'] = 0;
	$module_array['report_table'] = 0;
	$module_array['report_staff_service'] = 0;
	$module_array['verification_report'] = 0;
	$module_array['notification_template_module'] = 0;
	$module_array['settings_module'] = 0;
	$module_array['user_management_module'] = 0;
	$module_array['leads_module'] = 0;
	$module_array['leads'] = 0;
	$module_array['day_count'] = 0;
	$module_array['leads_import'] = 0;
	$module_array['leads_settings'] = 0;
	$module_array['sms_module'] = 0;
	$module_array['list_sms'] = 0;
	$module_array['status_order'] = 0;
	$module_array['list_orders'] = 0;
	$module_array['upload_orders'] = 0;
	$module_array['subcriptions'] = 0;
	$module_array['over_limit_sales'] = 0;
	$module_array['sale_module'] = 0;
	$module_array['all_sales'] = 0;
	$module_array['list_pos'] = 0;
	$module_array['list_draft'] = 0;
	$module_array['list_quotation'] = 0;
	$module_array['list_sell_return'] = 0;
	$module_array['shipment'] = 0;
	$module_array['discount'] = 0;
	$module_array['import_sale'] = 0;
	$module_array['reserved_stock'] = 0;
	$module_array['repair_module'] = 0;
	$module_array['catalogue_qr'] = 0;
	$module_array['business_settings'] = 0;
	$module_array['business_location'] = 0;
	$module_array['invoice_settings'] = 0;
	$module_array['tax_rates'] = 0;
	$module_array['list_easy_payment'] = 0;
	$module_array['payday'] = 0;
	
	$module_array['patient_module'] = 0;
	

    $module_array['purchase_module'] = 0;
    $module_array['all_purchase'] = 0;
    $module_array['add_purchase'] = 0;
    $module_array['import_purchase'] = 0;
    $module_array['add_bulk_purchase'] = 0;
    $module_array['purchase_return'] = 0;

     $module_array['cheque_write_module'] = 0;
     $module_array['cheque_templates'] = 0;
     $module_array['chequer_dashboard'] = 0;
     $module_array['write_cheque'] = 0;
     $module_array['manage_stamps'] = 0;
     $module_array['manage_payee'] = 0;
     $module_array['cheque_number_list'] = 0;
     $module_array['deleted_cheque_details'] = 0;
     $module_array['printed_cheque_details'] = 0;
     $module_array['default_setting'] = 0;
     $module_array['petro_quota_module'] = 0;
     $module_array['stock_taking_module'] = 0;
     $module_array['installment_module'] = 0;
     
     $module_array['distribution_module'] = 0;
     $module_array['spreadsheet'] = 0;
     
     $module_array['allowance_deduction'] = 0;
     $module_array['essentials_module'] = 0;
     $module_array['essentials_todo'] = 0;
     $module_array['essentials_document'] = 0;
     $module_array['essentials_memos'] = 0;
     $module_array['essentials_reminders'] = 0;
     $module_array['essentials_messages'] = 0;
     $module_array['essentials_settings'] = 0;


	foreach ($module_array as $key => $module_value) {
		${$key} = 0;
	}
	$business_id = request()->session()->get('user.business_id');
	$subscription = Modules\Superadmin\Entities\Subscription::active_subscription($business_id);
	if (!empty($subscription)) {
		$pacakge_details = $subscription->package_details;
		$disable_all_other_module_vr = 0;
		if (array_key_exists('disable_all_other_module_vr', $pacakge_details)) {
			$disable_all_other_module_vr = $pacakge_details['disable_all_other_module_vr'];
		}
		foreach ($module_array as $key => $module_value) {
			if ($disable_all_other_module_vr == 0) {
				if (array_key_exists($key, $pacakge_details)) {
					${$key} = $pacakge_details[$key];
				} else {
					${$key} = 0;
				}
			} else {
				${$key} = 0;
				$disable_all_other_module_vr = 1;
				$visitors_registration_module = 1;
				$visitors = 1;
				$visitors_registration = 1;
				$visitors_registration_setting = 1;
				$visitors_district = 1;
				$visitors_town = 1;
			}
		}
	}
	if (auth()->user()->can('superadmin')) {
		foreach ($module_array as $key => $module_value) {
			${$key} = 1;
		}
		$disable_all_other_module_vr = 0;
	}
	
	
	
@endphp
<style>
    .skin-blue .main-sidebar {
    	background-color: @if( !empty($sidebar_setting->ls_side_menu_bg_color)) {{$sidebar_setting->ls_side_menu_bg_color}}
    	@endif;
    }
    .skin-blue .sidebar a {
    	color: @if( !empty($sidebar_setting->ls_side_menu_font_color)) {{$sidebar_setting->ls_side_menu_font_color}}
    	@endif;
    }
    .skin-blue .treeview-menu>li>a {
    	color: @if( !empty($sidebar_setting->sub_module_color)) {{$sidebar_setting->sub_module_color}}
    	@endif;
    }
    .skin-blue .sidebar-menu>li>.treeview-menu {
    	background: @if( !empty($sidebar_setting->sub_module_bg_color)) {{$sidebar_setting->sub_module_bg_color}}
    	@endif;
    }
</style>

@php $user = App\User::where('id', auth()->user()->id)->first(); $is_admin = $user->hasRole('Admin#' . request()->session()->get('business.id')) ? true : false; @endphp

<!-- Left side column. contains the logo and sidebar -->

@if(session()->get('business.is_patient') && $patient_module)
        <ul class="custom-overflow sidebar-menu navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="width: 220px !important;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-text mx-3">SYZYGY</div>
            </a>
           
            <!-- Divider -->
            <hr class="sidebar-divider">
            
            @if(session()->get('business.is_patient'))
            <li class="nav-item {{ $request->segment(1) == 'patient' ? 'active' : '' }}">
                <a href="{{action('PatientController@index')}}"> <i class="fa fa-dashboard"></i> <span> @lang('home.home')</span> </a>
            </li>
            @endif @if(session()->get('business.is_hospital'))
            <li class="nav-item {{ $request->segment(1) == 'patient' ? 'active' : '' }}">
                <a href="{{action('HospitalController@index')}}"> <i class="fa fa-dashboard"></i> <span> @lang('home.home')</span> </a>
            </li>
            @endif
            
            <li class="nav-item {{ $request->segment(1) == 'reports' ? 'active' : '' }}">
                <a href="{{action('ReportController@getUserActivityReport')}}">
					<i class="fa fa-eercast"></i>
					<span class="title">@lang('report.user_activity')</span>
				</a>
            </li>
            
            @if ($is_admin) @if(Module::has('Superadmin')) @includeIf('superadmin::layouts_v2.partials.subscription') @endif @if(request()->session()->get('business.is_patient'))
                <li class="nav-item @if( in_array($request->segment(1), ['family-members', 'superadmin', 'pay-online'])) {{'active active-sub'}} @endif">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#patientbs-menu"
                        aria-expanded="true" aria-controls="patientbs-menu">
                       <i class="fa fa-cog"></i>
                        <span>@lang('business.settings')</span>
                    </a>
                    <div id="patientbs-menu" class="collapse" aria-labelledby="patientbs-menu"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('business.settings'):</h6>
                            <a class="collapse-item {{ $request->segment(1) == 'family-member' ? 'active' : '' }}" href="{{action('FamilyController@index')}}">@lang('patient.family_member')</a>
                            
                            <a class="collapse-item {{ $request->segment(2) == 'family-subscription' ? 'active' : '' }}" href="{{action('\Modules\Superadmin\Http\Controllers\FamilySubscriptionController@index')}}">@lang('patient.family_subscription')</a>
                            
                             <a class="collapse-item {{ $request->segment(1) == 'pay-online' && $request->segment(2) == 'create' ? 'active active-sub' : '' }}" href="{{action('\Modules\Superadmin\Http\Controllers\PayOnlineController@create')}}">@lang('superadmin::lang.pay_online')</a>
                        </div>
                    </div>
                </li>
            @endif @endif


        </ul>
@else

 <ul class="custom-overflow sidebar-menu navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="width: 220px !important;max-height: 100vh;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-text mx-3">SYZYGY</div>
            </a>
           
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Call superadmin module if defined -->
            @if(Module::has('Superadmin')) @includeIf('superadmin::layouts_v2.partials.sidebar') @endif
            
            
            @if($home_dashboard) @if(auth()->user()->can('dashboard.data') && !auth()->user()->is_pump_operator && !auth()->user()->is_property_user)
            <li class="nav-item {{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a class="nav-link" href="{{action('HomeController@index')}}">
                    <i class="fa fa-clone"></i>
                    <span>@lang('home.home')</span></a>
            </li>
            
            @endif @endif @if(auth()->user()->is_pump_operator) @if(auth()->user()->can('pump_operator.dashboard'))
            <li class=" nav-item {{ $request->segment(1) == 'petro' && $request->segment(2) == 'pump-operators' && $request->segment(3) == 'dashboard' ? 'active' : '' }}">
                <a href="{{action('\Modules\Petro\Http\Controllers\PumpOperatorController@dashboard')}}"><i class="fa fa-tachometer"></i> <span>@lang('petro::lang.dashboard')</span></a>
            </li>
            @endif
            <li class="nav-item {{ $request->segment(1) == 'petro' && $request->segment(2) == 'pump-operators' && $request->segment(3) == 'pumper-day-entries' ? 'active' : '' }}">
                <a href="{{action('\Modules\Petro\Http\Controllers\PumperDayEntryController@index')}}"><i class="fa fa-calculator"></i> <span>@lang('petro::lang.pumper_day_entries')</span></a>
            </li>
            @endif
            
            @if ($is_admin && $patient_module)

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item treeview {{ in_array($request->segment(1), ['patient','medication']) ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#patientmodule-menu"
                        aria-expanded="true" aria-controls="patientmodule-menu">
                        <i class="fa fa-medkit"></i>
                        <span>@lang('patient.module_name')</span>
                    </a>
                    <div id="patientmodule-menu" class="collapse" aria-labelledby="patientmodule-menu"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('patient.module_name'):</h6>
                            <a class="collapse-item {{ $request->segment(1) == 'patient' ? 'active' : '' }}" href="{{action('PatientController@index')}}">@lang('patient.home')</a>
                            <a class="collapse-item {{ $request->segment(1) == 'medication' ? 'active' : '' }}" href="{{action('MedicationController@index')}}">@lang('patient.medications')</a>
                        </div>
                    </div>
                </li>
    
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ in_array($request->segment(1), ['patient-test-records']) ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#patienttest-menu"
                        aria-expanded="true" aria-controls="patienttest-menu">
                        <i class="fa fa-heartbeat"></i>
                        <span>@lang('patient.test_records.module_name')</span>
                    </a>
                    <div id="patienttest-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('patient.test_records.module_name'):</h6>
                            <a class="collapse-item {{ $request->segment(1) == 'patient' ? 'active' : '' }}" href="{{action('PatientController@index')}}">@lang('patient.test_records.sugar_testing')</a>
                            
                            <a class="collapse-item {{ $request->segment(1) == 'patient' ? 'active' : '' }}" href="{{action('PatientController@index')}}">@lang('patient.test_records.pressure_testing')</a>
                        </div>
                    </div>
                </li>
            @endif
            
            
            @if(auth()->user()->is_customer == 0)
				@if(auth()->user()->can('crm.view'))
					@if($enable_crm == 1)
						<li class="nav-item {{ in_array($request->segment(1), ['crm']) ? 'active active-sub' : '' }}">
						    
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#crm-menu"
                                aria-expanded="true" aria-controls="crm-menu">
                                <i class="fa fa-users"></i>
                                <span>@lang('lang_v1.crm')</span>
                            </a>
                            <div id="crm-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">@lang('lang_v1.crm'):</h6>
                                    @can('crm.view')
                                        <a class="collapse-item {{ $request->segment(1) == 'crm' && $request->input('type') == 'customer' ? 'active' : '' }}" href="{{action('CRMController@index')}}">@lang('lang_v1.crm')</a>
                                        <a class="collapse-item {{ $request->segment(1) == 'crmgroups' ? 'active' : '' }}" href="{{action('CrmGroupController@index')}}">@lang('lang_v1.crm_group')</a>
                                    @endcan
                                    <a class="collapse-item {{ $request->segment(1) == 'crm-activity' ? 'active' : '' }}" href="{{action('CRMActivityController@index')}}">@lang('lang_v1.crm_activity')</a>
                                </div>
                            </div>
                        </li>
						
					@endif
				@endif
			@endif
			
			@if($leads_module)
				@includeIf('leads::layouts_v2.partials.sidebar')
			@endif
			
			
			 <!-- Start Task Management Module -->
            @if($tasks_management)
                @can('tasks_management.access')
                    @includeIf('tasksmanagement::layouts_v2.partials.sidebar')
                @endcan
            @endif
            
			
            
            
            @if($installment_module)
				@includeIf('installment::layouts.partials.sidebar')
			@endif
            
            @if(Auth::guard('agent')->check())
				@includeIf('agent::layouts_v2.partials.sidebar')
			@endif
			
			@if($contact_module)
				@if(auth()->user()->can('supplier.view') || auth()->user()->can('customer.view') )
				<li class="nav-item {{ in_array($request->segment(1), ['contacts', 'customer-group', 'contact-group', 'customer-reference', 'customer-statement', 'outstanding-received-report']) ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contacts-menu"
                        aria-expanded="true" aria-controls="contacts-menu">
                        <i class="ti-id-badge"></i>
                        <span>@lang('contact.contacts')</span>
                    </a>
                    <div id="contacts-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('contact.contacts'):</h6>
                            @if($contact_supplier) @can('supplier.view')
                                <a class="collapse-item {{ $request->input('type') == 'supplier' ? 'active' : '' }}" href="{{action('ContactController@index', ['type' => 'supplier'])}}">@lang('report.supplier')</a>
                            @endcan @endif @can('customer.view') @if($contact_customer) {{-- @if(!$property_module)--}}
                                <a class="collapse-item {{ $request->input('type') == 'customer' ? 'active' : '' }}" href="{{action('ContactController@index', ['type' => 'customer'])}}">@lang('report.customer')</a>
                            {{-- @endif--}} @endif @if($contact_group_customer)
                                <a class="collapse-item {{ $request->segment(1) == 'contact-group' ? 'active' : '' }}" href="{{action('ContactGroupController@index')}}">@lang('lang_v1.contact_groups')</a>
                            @endif @endcan @if($import_contact) @if(!$property_module && $contact_customer) @if(auth()->user()->can('supplier.create') || auth()->user()->can('customer.create') )
                                <a class="collapse-item {{ $request->segment(1) == 'contacts' && $request->segment(2) == 'import' ? 'active' : '' }}" href="{{action('ContactController@getImportContacts')}}">@lang('lang_v1.import_contacts')</a>
                            @endcan @endif @endif @if($customer_reference)    
                                <a class="collapse-item {{ $request->segment(1) == 'customer-reference' ? 'active' : '' }}" href="{{action('CustomerReferenceController@index')}}">@lang('lang_v1.customer_reference')</a>
                            @endif @if($contact_customer) @if($customer_statement)    
                                <a class="collapse-item {{ $request->segment(1) == 'customer-statement' ? 'active' : '' }}" href="{{action('CustomerStatementController@index')}}">@lang('contact.customer_statements')</a>
                            @endif @if($customer_payment)
                                <a class="collapse-item {{ $request->segment(1) == 'customer-payment-simple' ? 'active' : '' }}" href="{{action('CustomerPaymentController@index')}}">@lang('lang_v1.customer_payments')</a>
                            @endif @if($outstanding_received)
                                <a class="collapse-item {{ $request->segment(1) == 'outstanding-received-report' ? 'active' : '' }}" href="{{action('ContactController@getOutstandingReceivedReport')}}">@lang('lang_v1.outstanding_received')</a>
                                <a class="collapse-item {{ $request->segment(1) == 'import-balance' ? 'active' : '' }}" href="{{action('ContactController@getImportBalance')}}">@lang('lang_v1.import_contacts_balance')</a>
                            
                            @endif @endif @if($contact_supplier) @if($issue_payment_detail)
                                <a class="collapse-item {{ $request->segment(1) == 'issued-payment-details' ? 'active' : '' }}" href="{{action('ContactController@getIssuedPaymentDetails')}}">@lang('lang_v1.issued_payment_details')</a>
                        @endif @endif
                                <a class="collapse-item {{ $request->segment(1) == 'returned-cheque-details' ? 'active' : '' }}" href="{{action('ContactController@getReturnedCheques')}}">@lang('sale.returned_cheques_details')</a>
                        </div>
                    </div>
                </li>
					
				@endif
			@endif
			
			@if($property_module)
				@includeIf('property::layouts_v2.partials.sidebar')
			@endif

            @if($products)
				@if(auth()->user()->can('product.view') || auth()->user()->can('product.create') || auth()->user()->can('brand.view') || auth()->user()->can('unit.view') || auth()->user()->can('category.view') || auth()->user()->can('brand.create') || auth()->user()->can('unit.create') || auth()->user()->can('category.create') )
				
				     <li class="nav-item {{ in_array($request->segment(1), ['variation-templates', 'products', 'labels', 'import-products', 'import-opening-stock', 'selling-price-group', 'brands', 'units', 'categories', 'warranties']) ? 'active active-sub' : '' }}">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#products-menu"
                            aria-expanded="true" aria-controls="products-menu">
                            <i class="ti-layout-media-right-alt"></i>
                            <span>@lang('sale.products')</span>
                        </a>
                        <div id="products-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">@lang('sale.products'):</h6>
                                @can('product.view')
                                    <a class="collapse-item {{ $request->segment(1) == 'products' && $request->segment(2) == '' ? 'active' : '' }}" href="{{action('ProductController@index')}}">@lang('lang_v1.list_products')</a>
                                @endcan @can('product.create')    
                                    <a class="collapse-item {{ $request->segment(1) == 'products' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('ProductController@create')}}">@lang('product.add_product')</a>
                                @endcan @can('product.view')    
                                    <a class="collapse-item {{ $request->segment(1) == 'labels' && $request->segment(2) == 'show' ? 'active' : '' }}" href="{{action('LabelsController@show')}}">@lang('barcode.print_labels')</a>
                                @endcan @can('product.create')
                                    <a class="collapse-item {{ $request->segment(1) == 'variation-templates' ? 'active' : '' }}" href="{{action('VariationTemplateController@index')}}">@lang('product.variations')</a>
                                @endcan @can('product.create')    
                                    <a class="collapse-item {{ $request->segment(1) == 'import-products' ? 'active' : '' }}" href="{{action('ImportProductsController@index')}}">@lang('product.import_products')</a>
                                @endcan @if(session()->get('business.is_pharmacy'))
                                    <a class="collapse-item {{ $request->segment(1) == 'sample-medical-product-list' ? 'active' : '' }}" href="{{action('SampleMedicalProductController@index')}}">@lang('lang_v1.sample_medical_product_list')</a>
                                @endif @can('product.opening_stock')    
                                    <a class="collapse-item {{ $request->segment(1) == 'import-opening-stock' ? 'active' : '' }}" href="{{action('ImportOpeningStockController@index')}}">@lang('lang_v1.import_opening_stock')</a>
                                @endcan @can('product.create')    
                                    <a class="collapse-item {{ $request->segment(1) == 'selling-price-group' ? 'active' : '' }}" href="{{action('SellingPriceGroupController@index')}}">@lang('lang_v1.selling_price_group')</a>
                                @endcan @if(auth()->user()->can('unit.view') || auth()->user()->can('unit.create'))
                                    <a class="collapse-item {{ $request->segment(1) == 'units' ? 'active' : '' }}" href="{{action('UnitController@index')}}">@lang('unit.units')</a>
                                @endif @if(auth()->user()->can('category.view') || auth()->user()->can('category.create'))
                                    <a class="collapse-item {{ $request->segment(1) == 'categories' ? 'active' : '' }}" href="{{action('CategoryController@index')}}">@lang('category.categories')</a>
                                @endif @if(auth()->user()->can('brand.view') || auth()->user()->can('brand.create'))
                                    <a class="collapse-item {{ $request->segment(1) == 'brands' ? 'active' : '' }}" href="{{action('BrandController@index')}}">@lang('brand.brands')</a>
                                @endif
                                    <a class="collapse-item {{ $request->segment(1) == 'warranties' ? 'active active-sub' : '' }}" href="{{action('WarrantyController@index')}}">@lang('lang_v1.warranties')</a>
                                @if($stock_taking_page)    
                                    <a class="collapse-item {{ $request->segment(1) == 'stock-taking' ? 'active' : '' }}" href="{{action('StockTakingController@index')}}">@lang('mpcs::lang.StockTaking_form')</a>
                                @endif
    							@if($enable_petro_module) @if($merge_sub_category)
                                    <a class="collapse-item {{ $request->segment(1) == 'merged-sub-categories' ? 'active active-sub' : '' }}" href="{{action('MergedSubCategoryController@index')}}">@lang('lang_v1.merged_sub_categories')</a>
                                @endif @endif
                            </div>
                        </div>
                    </li>
				@endif
			@endif
			
			<!-- Start Petro Module -->
            @if($enable_petro_module) @if(auth()->user()->can('petro.access')) @includeIf('petro::layouts_v2.partials.sidebar') @endif @endif
            <!-- End Petro Module -->
            @if($distribution_module)
            <li class="nav-item {{ in_array($request->segment(1), ['distribution']) ? 'active active-sub' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#distribution-menu"
                    aria-expanded="true" aria-controls="distribution-menu">
                    <i class="ti-car"></i>
                    <span>Distribution</span>
                </a>
                <div id="distribution-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Distribution:</h6>
                        <a class="collapse-item {{ $request->segment(1) == 'vehicle' && $request->segment(2) == '' ? 'active' : '' }}" href="{{action('\Modules\Distribution\Http\Controllers\SettingController@index')}}">Settings</a>
                    </div>
                </div>
            </li>
            @endif
            
            @if($spreadsheet)
            <li class="nav-item {{ in_array($request->segment(1), ['spreadsheet']) ? 'active active-sub' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#spreadsheet-menu"
                    aria-expanded="true" aria-controls="spreadsheet-menu">
                    <i class="fas fa fa-file-excel"></i>
                    <span>Spreadsheet</span>
                </a>
                <div id="spreadsheet-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Spreadsheet:</h6>
                        
                        <a class="collapse-item {{ $request->segment(1) == 'spreadsheet' && $request->segment(2) == '' ? 'active' : '' }}" href="{{action([\Modules\Spreadsheet\Http\Controllers\SpreadsheetController::class, 'index'])}}">Spreadsheet</a>
                    </div>
                </div>
            </li>
            @endif
            
            @if($petro_quota_module)
            
                <li class="nav-item {{ in_array($request->segment(1), ['vehicles']) ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#petroquota-menu"
                        aria-expanded="true" aria-controls="petroquota-menu">
                        <i class="ti-car"></i>
                        <span>@lang('vehicle.petro_quota')</span>
                    </a>
                    <div id="petroquota-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('vehicle.petro_quota'):</h6>
                            
                            <a class="collapse-item {{ $request->segment(1) == 'vehicles' && $request->segment(2) == '' ? 'active' : '' }}" href="{{action('\Modules\Petro\Http\Controllers\VehicleController@vehicles_list')}}">@lang('vehicle.registered_vehicle_details')</a>
                        </div>
                    </div>
                </li>
            
			@endif


            <!-- Start MPCS Module -->
            @if($mpcs_module) @if(auth()->user()->can('mpcs.access')) @includeIf('mpcs::layouts_v2.partials.sidebar') @endif @endif
            <!-- End MPCS Module -->
            
            <!-- Start MPCS Module -->
            @if($stock_taking_module) @if(auth()->user()->can('mpcs.access')) @includeIf('Stocktaking::layouts_v2.partials.sidebar') @endif @endif
            <!-- End MPCS Module -->

            <!-- Start Fleet Module -->
            @if($fleet_module) @if(auth()->user()->can('fleet.access')) @includeIf('fleet::layouts_v2.partials.sidebar') @endif @endif
            <!-- End Fleet Module -->
    
    
            <!-- Start Ezyboat Module -->
            @if($ezyboat_module) {{-- @if(auth()->user()->can('ezyboat.access')) --}} @includeIf('ezyboat::layouts_v2.partials.sidebar') {{-- @endif --}} @endif
            <!-- End Ezyboat Module -->
           

             <!-- Start Gold Module -->
            @if($ran_module) @if(auth()->user()->can('ran.access')) @includeIf('ran::layouts_v2.partials.sidebar') @endif @endif
            <!-- End Gold Module -->
            
            
            @if(Module::has('Manufacturing')) @if($mf_module) @if(auth()->user()->is_customer == 0) @if(auth()->user()->can('manufacturing.access_recipe') || auth()->user()->can('manufacturing.access_production') )
            @include('manufacturing::layouts_v2.partials.sidebar') @endif @endif @endif @endif
            
            @if($purchase && $purchase_module)
                @if(in_array('purchase', $enabled_modules))
                    @if(auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') || auth()->user()->can('purchase.update') )
                        <li class="nav-item {{in_array($request->segment(1), ['purchases', 'purchase-return', 'import-purchases']) ? 'active active-sub' : '' }}">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchases-menu"
                                aria-expanded="true" aria-controls="purchases-menu">
                                <i class="ti-shopping-cart-full"></i>
                                <span>@lang('purchase.purchases')</span>
                            </a>
                            <div id="purchases-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">@lang('purchase.purchases'):</h6>
                                    @if($all_purchase)
                                        <a class="collapse-item {{ $request->segment(1) == 'purchases' && $request->segment(2) == null ? 'active' : '' }}" href="{{action('PurchaseController@index')}}">@lang('purchase.list_purchase')</a>
                                    @endif
                                    @if($add_bulk_purchase)    
                                        <a class="collapse-item {{ $request->segment(1) == 'purchases' && $request->segment(2) == 'add-purchase-bulk' ? 'active' : '' }}" href="{{action('PurchaseController@addPurchaseBulk')}}">@lang('purchase.add_purchase_bulk')</a>
                                    @endif
                                    @if($add_purchase)
                                        <a class="collapse-item {{ $request->segment(1) == 'purchases' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('PurchaseController@create')}}">@lang('purchase.add_purchase')</a>
                                    @endif
                                    @if($purchase_return)
                                        <a class="collapse-item {{ $request->segment(1) == 'purchase-return' ? 'active' : '' }}" href="{{action('PurchaseReturnController@index')}}">@lang('lang_v1.list_purchase_return')</a>
                                    @endif
                                    @if($import_purchase)
                                        <a class="collapse-item {{ $request->segment(1) == 'import-purchases'? 'active' : '' }}" href="{{action('ImportPurchasesController@index')}}">@lang('lang_v1.import_purchases')</a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        
                    @endif
                @endif
            @endif
            
            
            @if($sale_module)  @if(auth()->user()->can('sell.view') || auth()->user()->can('sell.create') || auth()->user()->can('direct_sell.access') ||
            auth()->user()->can('view_own_sell_only'))
                <li class="nav-item {{  in_array( $request->segment(1), ['sales', 'pos', 'sell-return', 'ecommerce', 'discount', 'shipments', 'import-sales', 'reserved-stocks']) ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sale-menu"
                        aria-expanded="true" aria-controls="sale-menu">
                        <i class="ti-shopping-cart"></i>
                        <span>@lang('sale.sale')</span>
                    </a>
                    <div id="sale-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('sale.sale'):</h6>
                            @if($all_sales) @if(auth()->user()->can('direct_sell.access') || auth()->user()->can('view_own_sell_only'))
                                <a class="collapse-item {{ $request->segment(1) == 'sales' && $request->segment(2) == null ? 'active' : '' }}" href="{{action('SellController@index')}}">@lang('lang_v1.all_sales')</a>
                            @endif @endif
                            <!-- Call superadmin module if defined -->
                            @if(Module::has('Ecommerce')) @includeIf('ecommerce::layouts_v2.partials.sell_sidebar') @endif @if($add_sale) @can('direct_sell.access')
                                <a class="collapse-item {{ $request->segment(1) == 'sales' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('SellController@create')}}">@lang('sale.add_sale')</a>
                            @endcan @endif @if($list_pos) @can('sell.view')
                                <a class="collapse-item {{ $request->segment(1) == 'pos' && $request->segment(2) == null ? 'active' : '' }}" href="{{action('SellPosController@index')}}">@lang('sale.list_pos')</a>
                            @endcan @endif @if(in_array('pos_sale', $enabled_modules)) @can('sell.create')    
                                <a class="collapse-item {{ $request->segment(1) == 'pos' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('SellPosController@create')}}">@lang('sale.pos_sale')</a>
                            @endcan @endif @if($list_draft) @can('list_drafts')    
                                <a class="collapse-item {{ $request->segment(1) == 'sales' && $request->segment(2) == 'drafts' ? 'active' : '' }}" href="{{action('SellController@getDrafts')}}">@lang('lang_v1.list_drafts')</a>
                            @endcan @endif @if($list_quotation) @can('list_quotations')    
                                <a class="collapse-item {{ $request->segment(1) == 'sales' && $request->segment(2) == 'quotations' ? 'active' : '' }}" href="{{action('SellController@getQuotations')}}">@lang('lang_v1.list_quotations')</a>
                            @endcan @endif @if($customer_order_own_customer == 1 || $customer_order_general_customer == 1) @if($list_orders)    
                                <a class="collapse-item {{ $request->segment(1) == 'sales' && $request->segment(2) == 'customer-orders' ? 'active' : '' }}" href="{{action('SellController@getCustomerOrders')}}">@lang('lang_v1.list_orders')</a>
                            @endif @if($upload_orders)
                                <a class="collapse-item {{ $request->segment(1) == 'sales' && $request->segment(2) == 'customer-orders' ? 'active' : '' }}" href="{{action('SellController@getCustomerUploadedOrders')}}">@lang('customer.uploaded_orders')</a>
                            @endif @endif @if($list_sell_return) @can('sell.view')
                                <a class="collapse-item {{ $request->segment(1) == 'sell-return' && $request->segment(2) == null ? 'active' : '' }}" href="{{action('SellReturnController@index')}}">@lang('lang_v1.list_sell_return')</a>
                            @endcan @endif @if($shipment) @can('access_shipping')
                                <a class="collapse-item {{ $request->segment(1) == 'shipments' ? 'active' : '' }}" href="{{action('SellController@shipments')}}">@lang('lang_v1.shipments')</a>
                            @endcan @endif @if($discount) @can('discount.access')
                                <a class="collapse-item {{ $request->segment(1) == 'discount' ? 'active' : '' }}" href="{{action('DiscountController@index')}}">@lang('lang_v1.discounts')</a>
                            @endcan @endif @if($subcriptions) @if(in_array('subscription', $enabled_modules) && auth()->user()->can('direct_sell.access'))
                                <a class="collapse-item {{ $request->segment(1) == 'subscriptions'? 'active' : '' }}" href="{{action('SellPosController@listSubscriptions')}}">@lang('lang_v1.subscriptions')</a>
                            @endif @endif @if($import_sale)
                                <a class="collapse-item {{ $request->segment(1) == 'import-sales'? 'active' : '' }}" href="{{action('ImportSalesController@index')}}">@lang('lang_v1.import_sales')</a>
                            @endif @if($reserved_stock)
                                <a class="collapse-item {{ $request->segment(1) == 'reserved-stocks'? 'active' : '' }}" href="{{action('ReservedStocksController@index')}}">@lang('lang_v1.reserved_stocks')</a>
                                
                            @endif @if($customer_settings) @if($over_limit_sales)   
                                <a class="collapse-item {{ $request->segment(1) == 'sales' && $request->segment(2) == 'over-limit-sales' ? 'active' : '' }}" href="{{action('SellController@overLimitSales')}}">@lang('sale.over_limit_sales')</a>
                           @endif @endif 
                        </div>
                    </div>
                </li>
            @endif @endif @if(Module::has('Repair')) @if($repair_module) @if(auth()->user()->can('repair.access'))

                @includeIf('repair::layouts.sidebar')
                @includeIf('autorepairservices::layouts.sidebar')

            @endif @endif @endif @if($stock_transfer) @if(in_array('stock_transfer', $enabled_modules)) @if(auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') )
                
                <li class="nav-item {{ $request->segment(1) == 'stock-transfers' || $request->segment(1) == 'stock-transfers-request'  ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#stocktransfer-menu"
                        aria-expanded="true" aria-controls="stocktransfer-menu">
                        <i class="fa fa-truck"></i>
                        <span>@lang('lang_v1.stock_transfers')</span>
                    </a>
                    <div id="stocktransfer-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('lang_v1.stock_transfers'):</h6>
                            @can('purchase.view')
                                <a class="collapse-item {{ $request->segment(1) == 'stock-transfers' && $request->segment(2) == null ? 'active' : '' }}" href="{{action('StockTransferController@index')}}">@lang('lang_v1.list_stock_transfers')</a>
                            @endcan @can('purchase.create')    
                                <a class="collapse-item {{ $request->segment(1) == 'stock-transfers' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('StockTransferController@create')}}">@lang('lang_v1.add_stock_transfer')</a>
                            @endcan {{-- @can('purchase.create') --}}    
                                <a class="collapse-item {{ $request->segment(1) == 'stock-transfers-request' && $request->segment(2) == null ? 'active' : '' }}" href="{{action('StockTransferRequestController@index')}}">@lang('lang_v1.stock_transfer_request')</a>
                            {{-- @endcan --}}
                        </div>
                    </div>
                </li>
            @endif @endif @endif {{-- @if($stock_adjustment)--}} {{-- @if(in_array('stock_adjustment', $enabled_modules))--}} {{-- @if(auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') )--}}
            
                <li class="nav-item {{ $request->segment(1) == 'stock-adjustments' ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#stockadjustments-menu"
                        aria-expanded="true" aria-controls="stockadjustments-menu">
                        <i class="fa fa-database"></i>
                        <span>@lang('stock_adjustment.stock_adjustment')</span>
                    </a>
                    <div id="stockadjustments-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('stock_adjustment.stock_adjustment'):</h6>
                            @can('purchase.view')
                                <a class="collapse-item {{ $request->segment(1) == 'stock-adjustments' && $request->segment(2) == null ? 'active' : '' }}" href="{{action('StockAdjustmentController@index')}}">@lang('stock_adjustment.list')</a>
                            @endcan @can('purchase.create')
                            <a class="collapse-item {{ $request->segment(1) == 'stock-adjustments' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('StockAdjustmentController@create')}}">@lang('stock_adjustment.add')</a>
                            @endcan
                        </div>
                    </div>
                </li>
            
            {{-- @endif--}} {{-- @endif--}} {{-- @endif--}} @if($expenses) @if(in_array('expenses', $enabled_modules)) @if(auth()->user()->can('expense.access'))
            
                <li class="nav-item {{  in_array( $request->segment(1), ['expense-categories', 'expenses']) ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#expenses-menu"
                        aria-expanded="true" aria-controls="expenses-menu">
                        <i class="fa fa-money"></i>
                        <span>@lang('expense.expenses')</span>
                    </a>
                    <div id="expenses-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('expense.expenses'):</h6>
                            <a class="collapse-item {{ $request->segment(1) == 'expenses' && empty($request->segment(2)) ? 'active' : '' }}" href="{{action('ExpenseController@index')}}">@lang('lang_v1.list_expenses')</a>
                            <a class="collapse-item {{ $request->segment(1) == 'expenses' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('ExpenseController@create')}}">@lang('messages.add') @lang('expense.expenses')</a>
                            
                            <a class="collapse-item {{ $request->segment(1) == 'expense-categories' ? 'active' : '' }}" href="{{action('ExpenseCategoryController@index')}}">@lang('expense.expense_categories')</a>
                        </div>
                    </div>
                </li>
            @endif @endif @endif
            <!-- Start hr Module -->
            @if($hr_module) @includeIf('hr::layouts_v2.partials.sidebar') @endif
            <!-- End hr Module -->
            <!-- Start PayRoll Module -->
            @if($payday) @if(auth()->user()->can('payday') && !auth()->user()->is_pump_operator && !auth()->user()->is_property_user)
                <li class="nav-item">
                    <a class="nav-link" href="#"  id="login_payroll">
                        <i class="fa fa-briefcase"></i>
                        <span>PayRoll</span></a>
                </li>
            
            @endif @endif
            <!-- End PayRoll Module -->
           
            @if($loan_module)
                 @include('loan::layouts.nav')
            @endif
            
            <!-- End Task Management Module -->
            @if($banking_module == 1 || $access_account == 1)
                @if(in_array('account', $enabled_modules) || in_array('banking_module', $enabled_modules))
                    @can('account.access')
                    <li class="nav-item {{ $request->segment(1) == 'accounting-module' ? 'active active-sub' : '' }}">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#accounting-menu"
                            aria-expanded="true" aria-controls="accounting-menu">
                            <i class="fa fa-money"></i>
                            <span>@if($access_account) @lang('account.accounting_module') @else @lang('account.banking_module') @endif</span>
                        </a>
                        <div id="accounting-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">@if($access_account) @lang('account.accounting_module') @else @lang('account.banking_module') @endif:</h6>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'account' ? 'active' : '' }}" href="{{action('AccountController@index')}}">@lang('account.list_accounts')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'disabled-account' ? 'active' : '' }}" href="{{action('AccountController@disabledAccount')}}">@lang('account.disabled_account')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'journals' ? 'active' : '' }}" href="{{action('JournalController@index')}}">@lang('account.list_journals')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'get-profit-loss-report' ? 'active' : '' }}" href="{{action('AccountController@getProfitLossReport')}}">@lang('lang_v1.profit_loss_report')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'income-statement' ? 'active' : '' }}" href="{{action('AccountReportsController@incomeStatement')}}">@lang('account.income_statement')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'balance-sheet' ? 'active' : '' }}" href="{{action('AccountReportsController@balanceSheet')}}">@lang('account.balance_sheet')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'trial-balance' ? 'active' : '' }}" href="{{action('AccountReportsController@trialBalance')}}">@lang('account.trial_balance')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'cash-flow' ? 'active' : '' }}" href="{{action('AccountController@cashFlow')}}">@lang('lang_v1.cash_flow')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'payment-account-report' ? 'active' : '' }}" href="{{action('AccountReportsController@paymentAccountReport')}}">@lang('account.payment_account_report')</a>
                                
                                <a class="collapse-item {{ $request->segment(1) == 'accounting-module' && $request->segment(2) == 'import' ? 'active' : '' }}" href="{{action('AccountController@getImportAccounts')}}">@lang('lang_v1.import_accounts')</a>
                            </div>
                        </div>
                    </li>
            
                    @endcan
                @endif
            @endif
            
            
            @if($report_module) @if(auth()->user()->can('report.access'))
            
            <li class="nav-item {{  in_array( $request->segment(1), ['reports']) ? 'active active-sub' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports-menu"
                    aria-expanded="true" aria-controls="reports-menu">
                    <i class="fa fa-bar-chart"></i>
                    <span>@lang('report.reports')</span>
                </a>
                <div id="reports-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">@lang('report.reports'):</h6>
                        @if($product_report) @if(auth()->user()->can('stock_report.view') || auth()->user()->can('stock_adjustment_report.view') || auth()->user()->can('item_report.view') || auth()->user()->can('product_purchase_report.view')
                            || auth()->user()->can('product_sell_report.view') || auth()->user()->can('product_transaction_report.view') )
                            <a class="collapse-item {{ $request->segment(2) == 'product' ? 'active' : '' }}" href="{{action('ReportController@getProductReport')}}">@lang('report.product_report')</a>
                        @endif @endif @if($payment_status_report) @if(auth()->user()->can('purchase_payment_report.view') || auth()->user()->can('sell_payment_report.view') || auth()->user()->can('outstanding_received_report.view') ||
                            auth()->user()->can('aging_report.view') )
                            
                            <a class="collapse-item {{ $request->segment(2) == 'payment-status' ? 'active' : '' }}" href="{{action('ReportController@getPaymentStatusReport')}}">@lang('report.payment_status_report')</a>
                        @endif @endif @if(auth()->user()->can('daily_report.view') || auth()->user()->can('daily_summary_report.view') || auth()->user()->can('register_report.view') || auth()->user()->can('profit_loss_report.view') )
                            <a class="collapse-item {{ $request->segment(2) == 'management' ? 'active' : '' }}" href="{{action('ReportController@getManagementReport')}}">@lang('report.management_report')</a>
                            
                        @endif @if($verification_report || $report_verification)
                            <a class="collapse-item {{ $request->segment(2) == 'verification' ? 'active' : '' }}" href="{{action('ReportController@getVerificationReport')}}">@lang('report.verification_reports')</a>
                        @endif @if($activity_report) @if(auth()->user()->can('sales_report.view') || auth()->user()->can('purchase_and_slae_report.view') || auth()->user()->can('expense_report.view') ||
                        auth()->user()->can('sales_representative.view') || auth()->user()->can('tax_report.view') )
                            <a class="collapse-item {{ $request->segment(2) == 'activity' ? 'active' : '' }}" href="{{action('ReportController@getActivityReport')}}">@lang('report.activity_report')</a>
                        @endif @endif @if($contact_report) @can('contact_report.view')
                            <a class="collapse-item {{ $request->segment(2) == 'contact' ? 'active' : '' }}" href="{{action('ReportController@getContactReport')}}">@lang('report.contact_report')</a>
                        @endcan @endif @can('stock_report.view') @if(session('business.enable_product_expiry') == 1)
                            <a class="collapse-item {{ $request->segment(2) == 'stock-expiry' ? 'active' : '' }}" href="{{action('ReportController@getStockExpiryReport')}}">@lang('report.stock_expiry_report')</a>
                        @endif @endcan @can('stock_report.view') @if(session('business.enable_lot_number') == 1)    
                            <a class="collapse-item {{ $request->segment(2) == 'lot-report' ? 'active' : '' }}" href="{{action('ReportController@getLotReport')}}">@lang('lang_v1.lot_report')</a>
                        @endif @endcan @if($trending_product) @can('trending_products.view')
                            <a class="collapse-item {{ $request->segment(2) == 'trending-products' ? 'active' : '' }}" href="{{action('ReportController@getTrendingProducts')}}">@lang('report.trending_products')</a>
                        @endcan @endif @if($user_activity) @can('user_activity.view')
                            <a class="collapse-item {{ $request->segment(2) == 'user_activity' ? 'active' : '' }}" href="{{action('ReportController@getUserActivityReport')}}">@lang('report.user_activity')</a>
        
                        @endcan @endif @if($report_table) @can('report_table.view')
                             <a class="collapse-item {{ $request->segment(2) == 'table-report' ? 'active' : '' }}" href="{{action('ReportController@getTableReport')}}">@lang('restaurant.table_report')</a>
                       @endcan @endif @if($report_staff_service) @can('sales_representative.view')
                           <a class="collapse-item {{ $request->segment(2) == 'service-staff-report' ? 'active' : '' }}" href="{{action('ReportController@getServiceStaffReport')}}">@lang('restaurant.service_staff_report')</a>
    
                        @endcan @endif
                            
                    </div>
                </div>
            </li>
            
            @endif @endif @if($catalogue_qr) @if(auth()->user()->can('catalogue.access'))
                <li class="nav-item {{  in_array( $request->segment(1), ['backup']) ? 'active active-sub' : '' }}">
                    <a class="nav-link" href="{{action('\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController@generateQr')}}">
                        <i class="fa fa-qrcode"></i>
                        <span>@lang('lang_v1.catalogue_qr')</span></a>
                </li>
            @endif @endif @if($backup_module) @can('backup')
                <li class="nav-item {{  in_array( $request->segment(1), ['backup']) ? 'active active-sub' : '' }}">
                    <a class="nav-link" href="{{action('BackUpController@index')}}">
                        <i class="fa fa-cloud-download"></i>
                        <span>@lang('lang_v1.backup')</span></a>
                </li>
            @endcan @endif
            
            
             <!-- Call restaurant module if defined -->
            @if($enable_booking)
            <!-- check if module in subscription -->
            @if(in_array('booking', $enabled_modules)) @if(auth()->user()->can('crud_all_bookings') || auth()->user()->can('crud_own_bookings') )
                <li class="nav-item {{ $request->segment(1) == 'bookings'? 'active active-sub' : '' }}">
                    <a class="nav-link" href="{{action('Restaurant\BookingController@index')}}">
                        <i class="fa fa-calendar-check-o"></i>
                        <span>@lang('restaurant.bookings')</span></a>
                </li>
            @endif @endif @endif @if($kitchen) @if(in_array('kitchen', $enabled_modules))
            
                <li class="nav-item {{ $request->segment(1) == 'modules' && $request->segment(2) == 'kitchen' ? 'active active-sub' : '' }}">
                    <a class="nav-link" href="{{action('Restaurant\KitchenController@index')}}">
                        <i class="fa fa-coffee"></i>
                        <span>@lang('restaurant.kitchen')</span></a>
                </li>
            
            @endif @endif @if($orders) @if(in_array('service_staff', $enabled_modules))
                <li class="nav-item {{ $request->segment(1) == 'modules' && $request->segment(2) == 'orders' ? 'active active-sub' : '' }}">
                    <a class="nav-link" href="{{action('Restaurant\OrderController@index')}}">
                        <i class="fa fa-clone"></i>
                        <span>@lang('restaurant.orders')</span></a>
                </li>
                
            @endif @endif @if($notification_template_module) @can('send_notifications')

               
                 <li class="nav-item {{ $request->segment(1) == 'notification-template' ? 'active active-sub' : '' }}">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#notification-template"
                            aria-expanded="true" aria-controls="notification-template">
                            <i class="fa fa-envelope"></i>
                            <span>@lang('lang_v1.notification_templates')</span>
                        </a>
                        <div id="notification-template" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">@lang('lang_v1.notification_templates'):</h6>
                                <a class="collapse-item {{ $request->segment(1) == 'notification-template' && $request->segment(2) == 'email' ? 'active' : '' }}" href="{{ url('notification-templates')}}?type=email">@lang('lang_v1.email')</a>
                                <a class="collapse-item {{ $request->segment(1) == 'notification-template' && $request->segment(2) == 'sms' ? 'active' : '' }}" href="{{ url('notification-templates')}}?type=sms">@lang('lang_v1.sms') & @lang('lang_v1.whatsapp')</a>
                               
                            </div>
                        </div>
                    </li>
                
            
            @endif @endrole 
            @php $business_or_entity = App\System::getProperty('business_or_entity'); @endphp 
                @if(!$disable_all_other_module_vr) 
                @if(!auth()->user()->is_pump_operator)
           
                <li class="nav-item @if( in_array($request->segment(1), ['pay-online', 'stores', 'business', 'tax-rates', 'barcodes', 'invoice-schemes', 'business-location', 'invoice-layouts', 'printers', 'subscription', 'types-of-service']) || in_array($request->segment(2), ['tables', 'modifiers']) ) {{'active active-sub'}} @endif">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings-menu"
                        aria-expanded="true" aria-controls="settings-menu">
                        <i class="fa fa-cogs"></i>
                        <span>@lang('business.settings')</span>
                    </a>
                    <div id="settings-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('business.settings'):</h6>
                            @if($settings_module) 
                            @can('business_settings.access') 
                            @if($business_settings)
                            @php \Log::error(json_encode($business_settings)); @endphp
                                <a class="collapse-item {{ $request->segment(1) == 'business' ? 'active' : '' }}" href="{{action('BusinessController@getBusinessSettings')}}">@if($business_or_entity == 'business'){{ __('business.business_settings') }} @elseif($business_or_entity == 'entity'){{ __('lang_v1.entity_settings') }} @else {{
                                    __('business.business_settings') }} @endif</a>
                            @endif 
                            @if($business_location)
                                <a class="collapse-item {{ $request->segment(1) == 'business-location' ? 'active' : '' }}" href="{{action('BusinessLocationController@index')}}">
                                    @if($business_or_entity == 'business'){{ __('business.business_locations') }} @elseif($business_or_entity == 'entity'){{ __('lang_v1.entity_locations') }} @else {{
                            __('business.business_locations') }} @endif</a>
                            @endif 
                                <a class="collapse-item {{ $request->segment(1) == 'stores' ? 'active' : '' }}" href="{{action('StoreController@index')}}">@lang('business.stores_settings')</a>
                             @endcan 
                            @can('invoice_settings.access') @if($invoice_settings)
                                <a class="collapse-item @if( in_array($request->segment(1), ['invoice-schemes', 'invoice-layouts']) ) {{'active'}} @endif" href="{{action('InvoiceSchemeController@index')}}">@lang('invoice.invoice_settings')</a>
                            @endif @endcan @can('barcode_settings.access')
                                <a class="collapse-item {{ $request->segment(1) == 'barcodes' ? 'active' : '' }}" href="{{action('BarcodeController@index')}}">@lang('barcode.barcode_settings')</a>
                            @endcan
                                <a class="collapse-item {{ $request->segment(1) == 'printers' ? 'active' : '' }}" href="{{action('PrinterController@index')}}">@lang('printer.receipt_printers')</a>
                             @if(auth()->user()->can('tax_rate.view') || auth()->user()->can('tax_rate.create')) @if($tax_rates)    
                                <a class="collapse-item {{ $request->segment(1) == 'tax-rates' ? 'active' : '' }}" href="{{action('TaxRateController@index')}}">@lang('tax_rate.tax_rates')</a>
                            @endif @endif  @if($customer_settings) @if(auth()->user()->can('customer_settings.access'))
                                <a class="collapse-item {{ $request->segment(1) == 'customer-settings' ? 'active' : '' }}" href="{{action('CustomerSettingsController@index')}}">@lang('lang_v1.customer_settings')></a>
                            @endif  @if(in_array('tables', $enabled_modules)) @can('business_settings.access')
                                <a class="collapse-item {{ $request->segment(1) == 'modules' && $request->segment(2) == 'tables' ? 'active' : '' }}" href="{{action('Restaurant\TableController@index')}}">@lang('restaurant.tables')</a>
                            @endcan @endif @if($expenses) @if(in_array('modifiers', $enabled_modules)) @if(auth()->user()->can('product.view') || auth()->user()->can('product.create') )
                                <a class="collapse-item {{ $request->segment(1) == 'modules' && $request->segment(2) == 'modifiers' ? 'active' : '' }}" href="{{action('Restaurant\ModifierSetsController@index')}}">@lang('restaurant.modifiers')</a>
                            @endif @endif @endif @endif @if(in_array('type_of_service', $enabled_modules) && !$property_module)    
                                <a class="collapse-item {{  $request->segment(1) == 'types-of-service' ? 'active active-sub' : '' }}" href="{{action('TypesOfServiceController@index')}}">@lang('lang_v1.types_of_service')</a>
                            @endif @endif @if(Module::has('Superadmin'))  @endif
                                <a class="collapse-item {{ $request->segment(1) == 'pay-online' && $request->segment(2) == 'create' ? 'active active-sub' : '' }}" href="{{action('\Modules\Superadmin\Http\Controllers\PayOnlineController@create')}}">@lang('superadmin::lang.pay_online')</a>
                        </div>
                    </div>
                </li>
            
            @endif @endif @if($enable_sms) @can('sms.access') @includeIf('sms::layouts_v2.partials.sidebar') @endcan @endif
            
            @if($member_registration) @can('member.access') @includeIf('member::layouts_v2.partials.sidebar') @endcan @endif
            
            
            @if(auth()->user()->hasRole('Super Manager#1'))
            
            <li class="nav-item {{ in_array($request->segment(1), ['super-manager']) ? 'active active-sub' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#visitors-menusup"
                    aria-expanded="true" aria-controls="visitors-menusup">
                    <i class="fa fa-group"></i>
                    <span>@lang('lang_v1.super_manager')</span>
                </a>
                <div id="visitors-menusup" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">@lang('lang_v1.super_manager'):</h6>
                        <a class="collapse-item {{ $request->segment(2) == 'visitors' ? 'active active-sub' : '' }}" href="{{action('SuperManagerVisitorController@index')}}">@lang('lang_v1.all_visitor_details')</a>
                    </div>
                </div>
            </li>
            
            @endif @if($visitors_registration_module) @includeIf('visitor::layouts_v2.partials.sidebar') @endif @if($user_management_module) @if(auth()->user()->can('user.view') || auth()->user()->can('user.create') ||
            auth()->user()->can('roles.view'))
                <li class="nav-item {{ in_array($request->segment(1), ['roles', 'users', 'sales-commission-agents']) ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user-menu"
                        aria-expanded="true" aria-controls="user-menu">
                        <i class="fa fa-group"></i>
                        <span>@lang('user.user_management')</span>
                    </a>
                    <div id="user-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('user.user_management'):</h6>
                            @can( 'user.view' )
                                <a class="collapse-item {{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}" href="{{action('ManageUserController@index')}}">@lang('user.users')</a>
                            @endcan @can('roles.view')
                                <a class="collapse-item {{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}" href="{{action('RoleController@index')}}">@lang('user.roles')</a>
                            @endcan @if($enable_sale_cmsn_agent == 1) @can('user.create')
                                <a class="collapse-item {{ $request->segment(1) == 'sales-commission-agents' ? 'active active-sub' : '' }}" href="{{action('SalesCommissionAgentController@index')}}"> @lang('lang_v1.sales_commission_agents')</a>
                            @endcan @endif
                        </div>
                    </div>
                </li>
                
            @endif @endif
            <!-- call Project module if defined -->
            @if(Module::has('Project')) @includeIf('project::layouts.partials.sidebar') @endif
            <!-- call Essentials module if defined -->
            @if(Module::has('Essentials')) 
                @if($hr_module)
                    @includeIf('essentials::layouts.partials.sidebar_hrm') 
                @endif
                
                @if($essentials_module)
                    @includeIf('essentials::layouts.partials.sidebar')
                @endif
            @endif
            
            
            @if(Module::has('Woocommerce'))
                @includeIf('woocommerce::layouts.partials.sidebar')
            @endif
            <!-- only customer accessable pages -->
            @if(auth()->user()->is_customer == 1)
            
                <li class="nav-item {{  in_array( $request->segment(1), ['customer-sales', 'customer-sell-return', 'customer-order', 'customer-order-list']) ? 'active active-sub' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer-menu"
                        aria-expanded="true" aria-controls="customer-menu">
                        <i class="fa fa-folder-open"></i>
                        <span>@lang('sale.sale')</span>
                    </a>
                    <div id="customer-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">@lang('sale.sale'):</h6>
                            
                            <a class="collapse-item {{ $request->segment(1) == 'customer-sales' ? 'active' : '' }}" href="{{action('CustomerSellController@index')}}">@lang('lang_v1.all_sales')</a>
                            
                            <a class="collapse-item {{ $request->segment(1) == 'customer-sell-return'  ? 'active' : '' }}" href="{{action('CustomerSellReturnController@index')}}">@lang('lang_v1.list_sell_return')</a>
                            
                            <a class="collapse-item {{ $request->segment(1) == 'customer-order' ? 'active' : '' }}" href="{{action('CustomerOrderController@create')}}">@lang('lang_v1.order')</a>
                            
                            <a class="collapse-item {{ $request->segment(1) == 'customer-order-list' ? 'active' : '' }}" href="{{action('CustomerOrderController@getOrders')}}">@lang('lang_v1.list_order')</a>
                            
                        </div>
                    </div>
                </li>
            @endif
            <!-- end only customer accessable pages -->
            @if($enable_cheque_writing == 1)
                @if(auth()->user()->can('enable_cheque_writing'))
            
            <li class="nav-item {{  in_array( $request->segment(1), ['cheque-templates', 'cheque-write', 'stamps', 'cheque-numbers','payees','deleted_cheque_details','printed_cheque_details','default_setting','cheque-dashboard']) ? 'active active-sub' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cheque-menu"
                    aria-expanded="true" aria-controls="cheque-menu">
                    <i class="fa fa-folder-open"></i>
                    <span>@lang('cheque.cheque_writing_module')</span>
                </a>
                <div id="cheque-menu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">@lang('cheque.cheque_writing_module'):</h6>
                        
                        <a class="collapse-item {{ $request->segment(1) == 'cheque-dashboard'  && $request->segment(2) == '' ? 'active' : '' }}" href="{{ url('chequerDashboard') }}">Chequer Dashboard</a>
                        
                        
                        @if($cheque_templates)
                            <a class="collapse-item {{ $request->segment(1) == 'cheque-templates'  && $request->segment(2) == '' ? 'active' : '' }}" href="{{action('Chequer\ChequeTemplateController@index')}}">@lang('cheque.templates')</a>
                            
                            <a class="collapse-item {{ $request->segment(1) == 'cheque-templates' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('Chequer\ChequeTemplateController@create')}}">@lang('cheque.add_new_templates')</a>
                        @endif
                        @if($write_cheque)
                            <a class="collapse-item {{ $request->segment(1) == 'cheque-write' && $request->segment(2) == 'create' ? 'active' : '' }}" href="{{action('Chequer\ChequeWriteController@create')}}">@lang('cheque.write_cheque')</a>
                        @endif
                        @if($manage_stamps)
                            <a class="collapse-item {{ $request->segment(1) == 'stamps' && $request->segment(2) == '' ? 'active' : '' }}" href="{{action('Chequer\ChequerStampController@index')}}">@lang('cheque.manage_stamps')</a>
                        @endif
                        @if($manage_payee)
                            <a class="collapse-item {{ $request->segment(1) == 'payees' && $request->segment(2) == '' ? 'active' : '' }}" href="{{url('payees')}}">Manage Payee</a>
                        @endif
                        @if($cheque_number_list)
                            <a class="collapse-item {{ $request->segment(1) == 'cheque-numbers' && $request->segment(2) == '' ? 'active' : '' }}" href="{{action('Chequer\ChequeNumberController@index')}}">@lang('cheque.cheque_number_list')</a>
                        @endif
                        @if($deleted_cheque_details)
                            <a class="collapse-item {{ $request->segment(1) == 'deleted_cheque_details' && $request->segment(2) == '' ? 'active' : '' }}" href="{{url('deleted_cheque_details')}}">Cancelled Cheques</a>
                        @endif
                        @if($printed_cheque_details)
                            <a class="collapse-item {{ $request->segment(1) == 'printed_cheque_details' && $request->segment(2) == '' ? 'active' : '' }}" href="{{url('printed_cheque_details')}}">Printed Cheque Details.</a>
                        @endif
                        @if($default_setting)
                            <a class="collapse-item {{ $request->segment(1) == 'default_setting' && $request->segment(2) == '' ? 'active' : '' }}" href="{{url('default_setting')}}">Default Settings</a>
                        @endif
                    </div>
                </div>
            </li>
            @endif
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


        </ul>
        
@endif
