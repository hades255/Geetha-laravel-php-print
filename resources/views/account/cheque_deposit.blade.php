<div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">
  
      {!! Form::open(['url' => action('AccountController@postChequeDeposit'), 'method' => 'post', 'id' => 'deposit_form',
      'enctype' => 'multipart/form-data' ]) !!}
  
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang( 'account.cheque_deposit' )</h4>
      </div>
  
      <div class="modal-body">
          <div class="col-md-4">
            <div class="form-group" style="margin-top: 28px;">
                <strong>@lang('account.selected_account')</strong>:
                {{$account->name}}
                {!! Form::hidden('account_id', $account->id) !!}
              </div>
          </div>
        <!-- TKNeal Removed Balance field from this positoin -->
          <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('operation_date', __( 'account.transaction_date' ) .":*") !!}
                {!! Form::text('operation_date', null, ['class' => 'form-control pull-right transaction_date', 'id' => 'transaction_date', 'required','placeholder' => __(
                'account.transaction_date' ) ]); !!}
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  {!! Form::label('transaction_date_range_cheque_deposit', __('report.date_range') . ':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    {!! Form::text('transaction_date_range_cheque_deposit', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]) !!}
                  </div>
                </div>
              </div>
              
              <div class="col-sm-4">
                    <div class="form-group">
                      {!! Form::label('customer_cheque_no', __('lang_v1.customer_cheque_number').':') !!}
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-exchange"></i></span><!-- @eng START 13/2 -->
                        {!! Form::select('customer_cheque_no', [], null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all'), 'id' => "cheque_customer_cheque_no"]) !!}
                      </div><!-- @eng END 13/2 -->
                </div>
            </div>
            
            <div class="col-sm-3">
                <div class="form-group">
                  {!! Form::label('customer_amount', __('lang_v1.amount').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-exchange"></i></span><!-- @eng START 13/2 -->
                    {!! Form::select('customer_amount', [], null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all'), 'id' => "cheque_customer_amount"]) !!}
                  </div> <!-- @eng END 13/2 -->
                </div>
            </div>
              
          </div>
          
          
            
         
          <div class="clearfix"></div>
          <table class="table table-bordered table-striped" id="cheque_list_table">
            <thead>
             <tr>
             <th>@lang('account.select')</th>
             <th>@lang('lang_v1.name')</th>
             <th>@lang('account.cheque_no')</th>
             <th>@lang('account.cheque_date')</th>
             <th>@lang('account.bank')</th>
             <th>@lang('account.amount')</th>
            </tr>
          </thead>
          <tbody></tbody>
          </table>

          <div class="clearfix"></div>
        
        <div class="col-md-12 text-center">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('encash', '1', false,
                    [ 'class' => 'input-icheck','id' => 'encash']); !!} {{ __( 'account.encash' ) }}
                </label>
            </div>
        </div>
     
        <div class="form-group">
          {!! Form::label('from_account', __( 'account.deposit_to' ) .":") !!}
          {!! Form::select('from_account', $to_accounts, null, ['class' => 'form-control select2', 'placeholder' =>
          __('messages.please_select'), 'required' ]); !!}
        </div>
  
  
        <div class="form-group">
          {!! Form::label('note', __( 'brand.note' )) !!}
          {!! Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]);
          !!}
        </div>
  
        <div class="form-group">
          {!! Form::label('attachment', __( 'lang_v1.add_image_document' )) !!}
          {!! Form::file('attachment', ['files' => true]); !!}
        </div>
      </div>
  
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary submit_btn">@lang( 'messages.submit' )</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
      </div>
  
      {!! Form::close() !!}
  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  
  <script type="text/javascript">
    $(document).ready( function(){
        $('#cheque_customer_cheque_no, #cheque_customer_amount').change(function(){
            get_cheques_list();
        })
    
    
        $.ajax({
            method: 'get',
            url: '/customer-payment-information/all/cheque_no',
            data: {},
            success: function (result) {
                var options = result.data;
                var selectElement = $('#cheque_customer_cheque_no');
                
                // Clear existing options
                selectElement.empty();
                
                // Add new options
                selectElement.append($('<option></option>').attr('value', "").text("@lang('lang_v1.all')"));
                $.each(options, function(index, value) {
                  selectElement.append($('<option></option>').attr('value', value).text(value));
                });
            },
        });
        $.ajax({
            method: 'get',
            url: '/customer-payment-information/all/amount',
            data: {},
            success: function (result) {
                
                if (result.data.length === 0 || result.data[0] !== '') {
                  result.data.unshift('');
                }
                
                var options = result.data;
                                
                var selectElement = $('#cheque_customer_amount');
                
                // Clear existing options
                selectElement.empty();
                
                // Add new options
                selectElement.append($('<option></option>').attr('value', "").text("@lang('lang_v1.all')"));
                $.each(options, function(index, value) {
                  selectElement.append($('<option></option>').attr('value', value).text(value));
                });
            },
        }); 
    
    
      $('#transaction_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format
      });
      
      
      
      $('#encash').change(function() {
        if ($(this).is(':checked')) {
            $("#from_account").prop('disabled', true);
        } else {
          $("#from_account").prop('disabled', false);
        }
      });
      
      
    });

    $('#transaction_date_range_cheque_deposit').daterangepicker(
      dateRangeSettings,
      function (start, end) {
        $('#transaction_date_range_cheque_deposit').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));

        get_cheques_list();
        }
    );
    
    $('#transaction_date_range_cheque_deposit')
                .data('daterangepicker')
                .setStartDate(moment().startOf('month'));
    $('#transaction_date_range_cheque_deposit')
        .data('daterangepicker')
        .setEndDate(moment().endOf('month'));

    $('#transaction_date_range_cheque_deposit').trigger('change');
    $('.select2').select2();
  </script>