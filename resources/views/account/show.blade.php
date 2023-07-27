@extends('layouts.app')
@section('title', __('account.account_book'))

@section('content')
<!-- Content Header (Page header) -->

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">@lang('account.account_book')</h4>
                <ul class="breadcrumbs pull-left" style="margin-top: 15px">
                    <li><a href="#">@lang('lang_v1.payment_accounts')</a></li>
                    <li><span>@lang('account.account_book')</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content main-content-inner">
    
  <div class="row">
    <div class="col-sm-4 col-xs-6">
      <div class="box box-solid">
        <div class="box-body">
          <table class="table">
            <tr>
              <th>@lang('account.account_name'): </th>
              <td>{{$account->name}}</td>
            </tr>
            <tr>
              <th>@lang('lang_v1.account_type'):</th>
              <td>@if(!empty($account->account_type->parent_account)) {{$account->account_type->parent_account->name}} - @endif {{$account->account_type->name ?? ''}}</td>
            </tr>
            <tr>
              <th>@lang('account.account_number'):</th>
              <td>{{$account->account_number}}</td>
            </tr>
            <tr>
              <th>@lang('lang_v1.balance'):</th>
              <td><span id="account_balance"></span></td>
            </tr>
{{--            <tr>--}}
{{--              <th>Description:</th>--}}
{{--              <td><span id="description"></span></td>--}}
{{--            </tr>--}}

          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-8 col-xs-8">
      <div class="box box-solid">
        <div class="box-body"> 
          
              @component('components.filters', ['title' => __('report.filters')])
                <div class="row">
                        <div class="col-sm-4">
                        <div class="form-group">
                          {!! Form::label('transaction_date_range', __('report.date_range') . ':') !!}
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            {!! Form::text('transaction_date_range', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]) !!}
                          </div>
                        </div>
                      </div>
                     
                          <div class="col-sm-4">
                            <div class="form-group">
                              {!! Form::label('transaction_customer', __('report.customer') . ':') !!}
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                {!! Form::select('transaction_customer', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all'), "id"=>"transaction_customer"]) !!}
                              </div>
                            </div>
                          </div>
                
                          <div class="col-sm-4">
                            <div class="form-group">
                              {!! Form::label('transaction_supplier', __('report.supplier') . ':') !!}
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                {!! Form::select('transaction_supplier', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all'), 'id' => "transaction_supplier" ]) !!}
                              </div>
                            </div>
                          </div>
                    </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                          {!! Form::label('customer_amount', __('lang_v1.amount').':') !!}
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span><!-- @eng START 13/2 -->
                            {!! Form::select('customer_amount', [], null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all'), 'id' => "customer_amount"]) !!}
                          </div> <!-- @eng END 13/2 -->
                        </div>
                      </div>
                    <div class="col-sm-4">
                                <div class="form-group">
                                  {!! Form::label('transaction_type', __('account.transaction_type') . ':') !!}
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                    {!! Form::select('transaction_type', ['' => __('messages.all'),'debit' => __('account.debit'), 'credit' => __('account.credit')], '', ['class' => 'form-control select2']) !!}
                                  </div>
                                </div>
                              </div>
                    @if($id == $card_account_id)
                  <div class="col-sm-4">
                    <div class="form-group">
                      {!! Form::label('card_type', __('lang_v1.card_type') . ':') !!}
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                        {!! Form::select('card_type', $card_type_accounts, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]) !!}
                      </div>
                    </div>
                  </div>
                  @else
                  
                  @if($account->parent_account_id != $card_account_id)
                      <div class="col-sm-4">
                            <div class="form-group">
                              {!! Form::label('customer_cheque_no', __('lang_v1.customer_cheque_number').':') !!}
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span><!-- @eng START 13/2 -->
                                {!! Form::select('customer_cheque_no', [], null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all'), 'id' => "customer_cheque_no"]) !!}
                              </div><!-- @eng END 13/2 -->
                        </div>
                      </div>
                    @else
                    <div class="col-sm-4">
                            <div class="form-group">
                              {!! Form::label('slip_no', __('petro::lang.slip_no').':') !!}
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span><!-- @eng START 13/2 -->
                                {!! Form::select('slip_no', $slipNos, null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all'), 'id' => "slip_no"]) !!}
                              </div><!-- @eng END 13/2 -->
                        </div>
                      </div>
                    @endif
                  
                  @endif
                </div>
                <div class="row">
                  
                  
              
                  
                </div>
              @endcomponent
          
        </div>
      </div>
    </div>
  </div>
  
   <!-- @eng START 12/2 -->
   <style>
       .the_blue_bg {
           background-color: #E6EBF6;
       }
       .the_purple_bg {
           background-color: #EDE2F6;
       }
   </style>
   <?php
        $creditClassName = '';
        $debitClassName = '';
        $accTypeName = $account->account_type->name;
        if(strpos($accTypeName, 'Assets') !== false || strpos($accTypeName, 'Expenses') !== false) { // @eng 13/2
            $debitClassName = "the_blue_bg";
            $creditClassName = "the_purple_bg";
        }
        else {
            $debitClassName = "the_purple_bg";
            $creditClassName = "the_blue_bg";
        }
   ?>
   <hr>
   <!-- @eng END 12/2 -->
  <div class="row">
    <div class="col-sm-12">
     <div class="box">
      <div class="box-body">
         
        @can('account.access')
        <div class="table-responsive">
        <div id="hiddenDiv"></div>
         <table class="table table-bordered table-striped" id="account_book">
          <thead>
           <tr>
            <th>@lang( 'messages.action' )</th>
            <th>@lang( 'messages.date' )</th>
            <!--<th>@lang( 'lang_v1.ref_no' )</th>-->
            <th>@lang( 'lang_v1.description' )</th>
            @if($account->asset_type == $cheque_in_hand_group_id || $account->asset_type == $bank_group_id || $account->id == $cheque_return_account_id)
            <th>@lang('lang_v1.cheque_number')</th>
            @endif
            @if($account->id == $card_account_id)
            <th>@lang( 'lang_v1.card_type' )</th>
            @else
            <th>@lang( 'lang_v1.note' ) </th> 
            @endif
            
            @if($account->parent_account_id != $card_account_id)
                 <th>@lang( 'lang_v1.image' )</th>
            @else
                 <th>@lang( 'petro::lang.slip_no' )</th>
            @endif
           
            <th>@lang( 'lang_v1.added_by' )</th>
            <th>@lang( 'lang_v1.opening_balance' )</th>
            <th>@lang('account.debit')</th>
            <th>@lang('account.credit')</th>
            <th>@lang( 'lang_v1.remaining_balance' )</th>
            <th>@lang('account.reconcile_status')</th>
          </tr>
        </thead>
        <tfoot>
          <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="@if($account->asset_type == $cheque_in_hand_group_id || $account->asset_type == $bank_group_id || $account->id == $cheque_return_account_id) 6 @else 5 @endif"><strong>@lang('sale.total'):</strong></td>
            <td></td>
            <td></td>
            <td><span id="footer_debit_total" class="display_currency" data-currency_symbol="true"></span></td>
            <td><span id="footer_credit_total" class="display_currency" data-currency_symbol="true"></span></td>
            <td></td>
            <td></td>
          </tr>
      </tfoot>
      </table>
    </div>
    @endcan
  </div>
</div>
</div>
</div>


<div class="modal fade" id="noteModal" role="dialog" 
aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">@lang( 'lang_v1.note' )</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <p id="noteContent" class="text-center text-bold"></p>
        </div>

      </div>
    </div>
  </div>


<div class="modal fade at_modal" tabindex="-1" role="dialog" 
aria-labelledby="gridSystemModalLabel">
<div class="modal fade account_model" tabindex="-1" role="dialog" 
aria-labelledby="gridSystemModalLabel">
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
      
      
      
       $(document).on('click', 'button.note_btn', function(e){
          let note = $(this).data('string');
          $("#noteContent").html(note);
          $("#noteModal").modal('show');
           
        });
      
      
    var body = document.getElementsByTagName("body")[0];
    body.className += " sidebar-collapse";

    update_account_balance();
    // update_description();

    // @eng START 19/2
    $.ajax({
        method: 'get',
        url: '/customer-payment-information/all/cheque_no',
        data: {},
        success: function (result) {
            $('#customer_cheque_no').populate(result.data);
        },
    });
    $.ajax({
        method: 'get',
        url: '/customer-payment-information/all/amount',
        data: {},
        success: function (result) {
            $('#customer_amount').populate(result.data);
        },
    });    
    // @eng END 19/2

    dateRangeSettings.startDate = moment().startOf('month');
    dateRangeSettings.endDate = moment().endOf('month');
    
    $('#transaction_date_range').daterangepicker(
      dateRangeSettings,
      function (start, end) {
        $('#transaction_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        
        account_book.order([[0, 'asc']]);
        
        account_book.ajax.reload();
      }
      );


    // $(document).on('click', 'button.reconcile_status_btn', function(e){
    //   let href = $(this).data('href');
    //     if (confirm('Are you sure you want to proceed?')) {
    //         $.ajax({
    //             method: 'get',
    //             url: href,
    //             data: {  },
    //             success: function(result) {
    //               if(result.success){
    //                 toastr.success('Success');
    //                 account_book.ajax.reload();
    //               }
    //             },
    //           });
    //     }
      
    // });


        // Account Book
        account_book = $('#account_book').DataTable({
          language: {
              "emptyTable": "@if(!$account_access) {{App\System::getProperty('not_enalbed_module_user_message')}} @else @lang('account.no_data_available_in_table') @endif"
          },
          processing: true,
          serverSide: false,
          pageLength: 25,
          aaSorting: [0,'asc'],
          ajax: {
            url: '{{action("AccountController@show",[$account->id])}}',
            data: function(d) {
              var start = '';
              var end = '';
              if($('#transaction_date_range').val()){
                start = $('input#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                end = $('input#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');                
              }
              var transaction_type = $('select#transaction_type').val();
              var customer = $('select#transaction_customer').val();
              var supplier = $('select#transaction_supplier').val();
              var amount = $('select#customer_amount').val();
              var customer_cheque_no = $('select#customer_cheque_no').val();
              d.start_date = start;
              d.end_date = end;
              d.type = transaction_type;
              d.customer = customer;
              d.supplier = supplier;
              d.amount = amount;
              d.customer_cheque_no = customer_cheque_no;
              d.is_iframe = "{{$is_iframe}}";

              if($('#card_type').length){
                d.card_type = $('#card_type').val();
              }
              if($('#cheque_number').length){
                d.cheque_number = $('#cheque_number').val();
              }
              
              if($('#slip_no').length){
                  console.log($('#slip_no').val());
                d.slip_no = $('#slip_no').val();
              }
            }
          },
          aaSorting: [[0, 'asc']],
          "ordering": true,
          "searching": true,
          columns: [
            {data: 'action', name: 'action'},
            {data: 'operation_date', name: 'operation_date', orderable:false},
            // {data: 'ref_no', name: 'ref_no'},
            {data: 'description', name: 'description'},
            @if($account->asset_type == $cheque_in_hand_group_id || $account->asset_type == $bank_group_id || $account->id == $cheque_return_account_id)
            {data: 'cheque_number', name: 'cheque_number'},
            @endif
            {data: 'note', name: 'note'},
            
            @if($account->parent_account_id != $card_account_id)
                 {data: 'attachment', name: 'attachment'},
            @else
                 {data: 'slip_no', name: 'slip_no'},
            @endif
            
            {data: 'added_by', name: 'u.first_name'},
            {data: 'opening_balance', name: 'opening_balance'},
            {data: 'debit', name: 'amount', className: '<?php echo $debitClassName; ?>'}, // @eng 12/2
            {data: 'credit', name: 'amount', className: '<?php echo $creditClassName ?>'}, // @eng 12/2
            {data: 'balance', name: 'balance', searchable: false},
            {data: 'reconcile_status', name: 'reconcile_status', searchable: false, sortable: false},
          ],
          @include('layouts.partials.datatable_export_button')
          "fnDrawCallback": function (oSettings) {
            var debit_total = sum_table_col($('#account_book'), 'debit_col');
            $('#footer_debit_total').text(debit_total);
            var credit_total = sum_table_col($('#account_book'), 'credit_col');
            $('#footer_credit_total').text(credit_total);
            __currency_convert_recursively($('#account_book'));
          }
        });

        $('#transaction_type').change( function(){
          account_book.ajax.reload();
        });
        $('#transaction_date_range').on('cancel.daterangepicker', function(ev, picker) {
          $('#transaction_date_range').val('');
          account_book.ajax.reload();
        });

      });
    // @eng START 19/2
    //   $('#card_type, #cheque_number,#customer_amount, #customer_cheque_no, #transaction_supplier').change(function(){
    //     account_book.ajax.reload();
    //   })
      $('#card_type, #cheque_number, #transaction_supplier,#customer_cheque_no,#slip_no').change(function(){
        account_book.ajax.reload();
      })      
    // @eng END 19/2 
  $(document).on('click', 'a.delete_account_transaction', function(e){
    e.preventDefault();
    swal({
      title: LANG.sure,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        var href = $(this).data('href');
        $.ajax({
          url: href,
          method: 'DELETE',
          dataType: "json",
          success: function(result){
            if(result.success === true){
              toastr.success(result.msg);
              account_book.ajax.reload();
              update_account_balance();
              // update_description();

            } else {
              toastr.error(result.msg);
            }
          }
        });
      }
    });
  });
   
  function update_account_balance(argument) {
    $('span#account_balance').html('<i class="fa fa-refresh fa-spin"></i>');
    $.ajax({
      url: '{{action("AccountController@getAccountBalance", [$account->id])}}',
      dataType: "json",
      success: function(data){
        $('span#account_balance').text(__currency_trans_from_en(data.balance, true));
      }
    });
  }

  {{--function update_description(){--}}
  {{--  $('span#description').html('<i class="fa fa-refresh fa-spin"></i>');--}}
  {{--  $.ajax({--}}
  {{--    url: '{{url('accounting-module/get-description/'.$account->id) }}',--}}
  {{--    dataType: "json",--}}
  {{--    success: function(data){--}}
  {{--      console.log(data);--}}
  {{--      $('span#description').text(data, true);--}}
  {{--    }--}}
  {{--  });--}}
  {{--}--}}


  //select box

$.fn.populate = function(data, callable = null) {
    $(this).empty()
    $(this).append(`<option value="">All</option>`)
    data.forEach(item=>{
        $(this).append(`<option value="${item}">${callable?callable(item):item}</option>`)
    })
}

$('#transaction_customer').change(function(){
  if($('#transaction_customer').val()){
        $.ajax({
        method: 'get',
        url: '/customer-payment-information/' + $(this).val() +'/amount',
        data: {},
        success: function (result) {
            $('#customer_amount').populate(result.data, (item)=>parseFloat(item).toFixed(2));
        },
        });

        $.ajax({
            method: 'get',
            url: '/customer-payment-information/' + $(this).val() +'/cheque_no',
            data: {},
            success: function (result) {
                $('#customer_cheque_no').populate(result.data);
            },
        });
    }
    account_book.ajax.reload();
})
// @eng START 19/2
$('#customer_cheque_no').change(function(){
//   if($('#customer_cheque_no').val()){
        // $.ajax({
        // method: 'get',
        // url: '/customer-payment-information/' + $(this).val() +'/amount',
        // data: {},
        // success: function (result) {
        //     $('#customer_amount').populate(result.data, (item)=>parseFloat(item).toFixed(2));
        // },
        // });
        var param = $("#customer_cheque_no option:selected").text() == 'All' ? 'all' : $(this).val();
        console.log(param, ' is param');

        $.ajax({
            method: 'get',
            url: '/customer-info-for/cheque_no/' +  param,
            data: {},
            success: function (result) {
                // $('#transaction_customer').populate(result.data);
                var newCustomerOptions = [];
                for (const [key, value] of Object.entries(result.data)) {
                    newCustomerOptions.push($('<option></option>').attr("value", key).text(value));
                    console.log(`${key}: ${value}`);
                }
                $("#transaction_customer").empty().append(newCustomerOptions);
                
                var newAmounts = [];
                for(let i = 0; i < result.amounts.length; i++) {
                    newAmounts.push($('<option></option>').attr('value', result.amounts[i]).text(result.amounts[i]));
                }
                $("#customer_amount").empty();
                $("#customer_amount").append(newAmounts).append($('<option></option>').text('All'));
                
                account_book.ajax.reload();
            },
        });
    // }
})
$('#customer_amount').change(function(){
        var param = $("#customer_amount option:selected").text() == 'All' ? 'all' : $(this).val();
        console.log(param, ' is param');

        $.ajax({
            method: 'get',
            url: '/customer-info-for/amount/' +  param,
            data: {},
            success: function (result) {
                var newCustomerOptions = [];
                for (const [key, value] of Object.entries(result.data)) {
                    newCustomerOptions.push($('<option></option>').attr("value", key).text(value));
                    console.log(`${key}: ${value}`);
                }
                $("#transaction_customer").empty().append(newCustomerOptions);
                
                var newCheques = [];
                for(let i = 0; i < result.cheques.length; i++) {
                    newCheques.push($('<option></option>').attr('value', result.cheques[i]).text(result.cheques[i]));
                }
                $("#customer_cheque_no").empty();
                $("#customer_cheque_no").append(newCheques).append($('<option></option>').text('All'));
                
                account_book.ajax.reload();
            },
        });
    // }
})
// @eng END 19/2
</script>
@endsection