@extends('layouts.app')
@section('title', __('lang_v1.'.$type.'s'))

@section('content')

<!-- Content Header (Page header) -->


<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Contacts</h4>
                <ul class="breadcrumbs pull-left" style="margin-top: 15px">
                    <li><a href="#">Contacts</a></li>
                    <li><span>Manage contacts</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>



<!-- Main content -->
<section class="content main-content-inner">
    <div class="row">
        <div class="col-sm-12">
            @component('components.filters', ['title' => __('report.filters')])
              <div class="form-group col-sm-4 form-inline">
                  
                  <div class="input-group">
                      {!! Form::label('user_id', __('lang_v1.assigned_to'), ['class' => 'mr-2']) !!}: &nbsp;
                    <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </span>
                    {!! Form::select('user_id', $user_groups, null, ['class' => 'form-control select2', 'id' => 'assigned_to']) !!}
                  </div>
                </div>

            @endcomponent
        </div>
    </div>
    
    
    @php
        if($type == 'customer'){
            $colspan = 15;

        }else{
            $colspan = 17;
        }

    @endphp
    <input type="hidden" value="{{$type}}" id="contact_type">
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'contact.all_your_contact', ['contacts' =>
    __('lang_v1.'.$type.'s') ])])
    
   <div class="box-tools pull-right">
        <input type="hidden" id="default_contact_id" value="{{ $contact_id ?? ''}}" >
        <button type="button" class="btn btn-primary btn-modal"
            data-href="{{action('ContactController@create', ['type' => $type])}}" data-container=".contact_modal">
            <i class="fa fa-plus"></i> @lang('messages.add')</button>
    </div>
        
    
    @if(auth()->user()->can('supplier.create') || auth()->user()->can('customer.create'))
    @slot('tool')
    
    @endslot
    @endif
    @if(auth()->user()->can('supplier.view') || auth()->user()->can('customer.view'))
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="width: 100%" id="contact_table">
            <thead>
                <tr>
                    <td colspan="9">
                        <div class="row">
                            <div class="col-sm-2">
                                @if(auth()->user()->can('customer.delete') || auth()->user()->can('supplier.delete'))
                                    {!! Form::open(['url' => action('ContactController@massDestroy'), 'method' => 'post', 'id'
                                    => 'mass_delete_form' ]) !!}
                                    {!! Form::hidden('selected_rows', null, ['id' => 'selected_rows']); !!}
                                    {!! Form::submit(__('lang_v1.delete_selected'), array('class' => 'btn btn-xs btn-danger',
                                    'id' => 'delete-selected')) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-sm-2">
                                {!! Form::open(['url' => action('ContactController@exportBalance'), 'method' => 'post', 'id'
                                => 'export_ob_form' ]) !!}
                                {!! Form::hidden('selected_rows', null, ['id' => 'ob_selected_rows']); !!}
                                {!! Form::submit(__('lang_v1.export'), array('class' => 'btn btn-xs btn-success',
                                'id' => 'export-selected')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                    </td>
                    <td>
                        <table style="min-width: 23rem">
                                <tr>
                                    <th>Total Outstanding</th>
                                    <td>:</td>
                                    <td>
                                        <span id="total_outstanding" class="display_currency" style="margin-left: 0.5rem;">0</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Overpayment</th>
                                    <td>:</td>
                                    <td>
                                        <span id="total_overpayment" class="display_currency" style="margin-left: 0.5rem;">0</span>
                                    </td>
                                </tr>
                            </table>
                    </td>
                </tr>
                
                <tr>
                    <th><input type="checkbox" id="select-all-row"></th>
                    <th class="notexport">@lang('messages.action')</th>
                    <th >@lang('lang_v1.contact_id')</th>
                    @if($type == 'supplier')
                    <th>@lang('business.business_name')</th>
                    <th>@lang('contact.name')</th>
                    <th>@lang('contact.mobile')</th>
                    <th>@lang('lang_v1.supplier_group')</th>
                    <th>Assign To</th>
                    <th>@lang('contact.pay_term')</th>
                    <th>@lang('contact.total_purchase_due')</th>
                    <th>@lang('lang_v1.total_purchase_return_due')</th>
                    <!--<th html="true">@lang('contact.opening_bal_due')</th>-->
                    <th>@lang('account.opening_balance')</th>
                    <th>@lang('business.email')</th>
                    <th>@lang('contact.tax_no')</th>
                    <th>@lang('lang_v1.added_on')</th>
                    @elseif( $type == 'customer')
                        <th>@lang('user.name')</th>
                        <th>@lang('contact.mobile')</th>
                        <th>@lang('lang_v1.customer_group')</th>
                        <th>Assign To</th>
                        <th>@lang('lang_v1.credit_limit')</th>
                        <th style="color: #9D0606">@lang('contact.total_due')</th>
                        <!-- <th width="150" style="min-width: 100px"> @lang('contact.total_sale_due')</th> -->
                        <th> @lang('lang_v1.total_sell_return_due') </th>
                        <th>@lang('contact.pay_term')</th>
                        <!-- <th width="125">@lang('account.opening_balance')</th> -->

                        <!--
                        <th>@lang('contact.tax_no')</th>
                        <th>@lang('business.email')</th>
                        <th>@lang('business.address')</th>
                        -->
                        <th>@lang('lang_v1.added_on')</th>
                    @if($reward_enabled)
                    <th id="rp_col">{{session('business.rp_name')}}</th>
                    @endif
                    @endif
                    <th class="contact_custom_field1 @if($is_property && !array_key_exists('property_customer_custom_field_1', $contact_fields)) hide @endif  @if($type=='customer' && !array_key_exists('customer_custom_field_1', $contact_fields)) hide @endif @if($type=='supplier' && !array_key_exists('supplier_custom_field_1', $contact_fields)) hide @endif">
                        @lang('lang_v1.contact_custom_field1')
                    </th>

                    <th class="contact_custom_field2 @if($is_property && !array_key_exists('property_customer_custom_field_2', $contact_fields)) hide @endif  @if($type=='customer' && !array_key_exists('customer_custom_field_2', $contact_fields)) hide @endif @if($type=='supplier' && !array_key_exists('supplier_custom_field_2', $contact_fields)) hide @endif">
                        @lang('lang_v1.contact_custom_field2')
                    </th>

                    <th class="contact_custom_field3 @if($is_property && !array_key_exists('property_customer_custom_field_3', $contact_fields)) hide @endif  @if($type=='customer' && !array_key_exists('customer_custom_field_3', $contact_fields)) hide @endif @if($type=='supplier' && !array_key_exists('supplier_custom_field_3', $contact_fields)) hide @endif">
                        @lang('lang_v1.contact_custom_field3')
                    </th>

                    <th class="contact_custom_field4 @if($is_property && !array_key_exists('property_customer_custom_field_4', $contact_fields)) hide @endif  @if($type=='customer' && !array_key_exists('customer_custom_field_4', $contact_fields)) hide @endif @if($type=='supplier' && !array_key_exists('supplier_custom_field_4', $contact_fields)) hide @endif">
                        @lang('lang_v1.contact_custom_field4')
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr class="bg-gray font-17 text-center footer-total">
                    <td @if($type=='supplier' ) colspan="8" @elseif( $type=='customer' ) @if($reward_enabled)
                        colspan="7" @else colspan="7" @endif @endif>
                        <strong>
                            @lang('sale.total'):
                        </strong>
                    </td>
                    
                    @if($type == 'supplier')
                    <td><span class="display_currency" id="footer_pay_term" data-currency_symbol="true"></span></td>
                    <td><span class="display_currency" id="footer_tot_due" data-currency_symbol="true"></span></td>
                    <td><span class="display_currency" id="footer_contact_return_due" data-currency_symbol="true"></span></td>
                    <td><span class="display_currency" id="footer_contact_opening_balance" data-currency_symbol="true"></span></td>
                    <td></td>
                    <td></td>
                    <td></td>
                     @endif
                    @if($type == 'customer')
                    <td><span class="display_currency" id="footer_tot_credit_limit" data-currency_symbol="true"></span></td>
                    <td><span class="display_currency" id="footer_tot_due" data-currency_symbol="true"></span></td>
                    <td><span class="display_currency" id="footer_contact_return_due" data-currency_symbol="true"></span></td>
                    <td><span class="display_currency" id="footer_pay_term" data-currency_symbol="true"></span></td>
                    <td></td>
                     @endif

                </tr>
            </tfoot>
        </table>
    </div>
    @endif
    @endcomponent

    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection

@section('javascript')

@if(session('status'))
    @if(session('status')['success'])
        <script>
            toastr.success('{{ session("status")["msg"] }}');
        </script>
    @else
        <script>
            toastr.error('{{ session("status")["msg"] }}');
        </script>
    @endif
@endif


<script>
    $('#contact_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#contact_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            contact_table.ajax.reload();
        }
    );
    $('#contact_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#contact_list_filter_date_range').val('');
        contact_table.ajax.reload();
    });
    $('.contact_modal').on('shown.bs.modal', function() {
        $('.contact_modal')
        .find('.select2')
        .each(function() {
            var $p = $(this).parent();
            $(this).select2({ 
                dropdownParent: $p
            });
        });

    });
    $(document).on('click', '#delete-selected', function(e){
        e.preventDefault();
        var selected_rows = getSelectedRows();

        if(selected_rows.length > 0){
        $('input#selected_rows').val(selected_rows);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                $('form#mass_delete_form').submit();
                }
            });
        } else{
        $('input#selected_rows').val('');
            swal('@lang("lang_v1.no_row_selected")');
        }
    });
    
    
    $(document).on('click', '#export-selected', function(e){
        e.preventDefault();
        var selected_rows = getSelectedRows();

        if(selected_rows.length > 0){
        $('input#ob_selected_rows').val(selected_rows);
            $('form#export_ob_form').submit();
        } else{
        $('input#ob_selected_rows').val('');
            swal('@lang("lang_v1.no_row_selected")');
        }
    });
    
    
    function getSelectedRows() {
        var selected_rows = [];
        var i = 0;
        $('.row-select:checked').each(function () {
            selected_rows[i++] = $(this).val();
        });

        return selected_rows;
    }
    // document.addEventListener("DOMContentLoaded", function(){
    //     $.ajax({
    //         method: 'get',
    //         url: '/contacts/get_outstanding?type='+ "{{$type}}",
    //         success: function(result) {
    //             if (result && Object.keys(result).length > 0) {
    //                 $('#total_outstanding').text(result.total_outstanding);
    //                 $('#total_overpayment').text(result.total_overpayment);
    //             // $('#total_os').html(result);
    //             __currency_convert_recursively($('#contact_table'));
    //             }
    //         },
    //     });

    // });
    $(document).on('change','#assigned_to',function(){
        $('#contact_table').DataTable().ajax.reload();

    });


</script>
@endsection
