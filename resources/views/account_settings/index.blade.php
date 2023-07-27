<style>
    .text-red{
        color: red;
    }
</style>

{!! Form::open(['url' => action('AccountSettingController@store'), 'method' => 'post', 'id' =>
'account_settings_add_form' ]) !!}

<!--<input type="hidden" id="customer_id" name="customer_id" required>-->
<input type="hidden" id="cheque_amount" name="cheque_amount" required>
<input type="hidden" id="cheque_date" name="cheque_date" required>
<input type="hidden" id="bank_name" name="bank_name" required>
<input type="hidden" id="cheque_number" name="cheque_number" required>

<div class="row">
    <div class="col-md-12">
        <h3>@lang('lang_v1.account_opening_balances')</h3>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="">
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('date', __( 'lang_v1.date' ) . ':') !!}
                    {!! Form::text('date', null, ['class' => 'form-control',
                    'placeholder' => __(
                    'lang_v1.date' ) ]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('group_id', __( 'lang_v1.account_group' ) . ':') !!}
                    {!! Form::select('group_id', $account_groups, null, ['placeholder' =>
                    __('messages.please_select'), 'required','style' => 'width: 100%', 'class' => 'form-control
                    select2']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('account_id', __( 'lang_v1.account' ) . ':') !!}
                    {!! Form::select('account_id', [], null, ['placeholder' =>
                    __('messages.please_select'), 'required','style' => 'width: 100%', 'class' => 'cheque_acc_id form-control
                    select2']) !!}
                </div>
            </div>
            
            <div class="col-md-3 chequeRelated" hidden>
                <div class="form-group">
                    {!! Form::label('customer_id', 'Customer:') !!}
                    {!! Form::select('customer_id', $customers, null, ['placeholder' =>
                    __('messages.please_select'),'style' => 'width: 100%', 'class' => 'cheque_customer_id form-control
                    select2']) !!}
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('amount', __( 'lang_v1.amount' ) . ':') !!}
                    {!! Form::text('amount', null, ['required','class' => 'form-control',
                    'placeholder' => __(
                    'lang_v1.amount' ) ]); !!}
                    <small class="text-red chequeRelated" hidden><b>Added: </b><span id="addedTotal">0</span>&nbsp;<b>Balance: </b><span id="balTotal">0</span> <span class="badge bg-danger" onClick="calculateTotals();popupModal();" style="cursor: pointer;">Edit</span> </small>
                </div>
            </div>
           
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <button type="submit" id="saveForm" class="btn btn-primary pull-right">@lang('lang_v1.save')</button>
    </div>
</div>

{!! Form::close() !!}
<br>
<div class="clearfix"></div>
<br>
 <div class="col-md-12">
      <div class="row">
        @component('components.filters', ['title' => __('report.filters')])
            <div class="col-md-4">
                <div class="form-group">
                {!! Form::label('date1', __( 'lang_v1.date' ) . ':') !!}
                {!! Form::text('date1', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.date' ) ]); !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('account_type1',  __('Account Type') . ':') !!}
                    {!! Form::select('account_type1', $account_types_opts, null, ['id'=>'account_type1','class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('account_sub_type1',  __('Account Sub Type') . ':') !!}
                    {!! Form::select('account_sub_type1', $sub_acn_arr, null, ['id'=>'account_sub_type1','class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                {!! Form::label('group_id2', __( 'lang_v1.account_group' ) . ':') !!}
                {!! Form::select('group_id2', $account_groups, null, ['placeholder' =>__('messages.please_select'), 'required','style' => 'width: 100%', 'class' => 'form-control select2']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                {!! Form::label('account_id2', __( 'lang_v1.account' ) . ':') !!}
                {!! Form::select('account_id2', [], null, ['placeholder' =>__('messages.please_select'), 'required','style' => 'width: 100%', 'class' => 'form-control select2']) !!}
                </div>
            </div>
        @endcomponent
      </div>
  </div>

<div class="row">
    <div class="col-md-12">
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="account_setting_table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>@lang( 'lang_v1.date' )</th>
                        <th>@lang( 'lang_v1.account_group' )</th>
                        <th>@lang( 'lang_v1.account' )</th>
                        <th>@lang( 'lang_v1.amount' )</th>
                        <th>@lang( 'lang_v1.added_by' )</th>
                        <th class="notexport">@lang( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
        </div>
    
    </div>
</div>

<div class="modal" id="viewCheques">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
        <div class="modal-header">
            <div class="row col-md-11">
                <div class="col-md-4">
                    <span class="text-red"><b>Customer: </b><span id="customerName"></span></span>
                </div>
                <div class="col-md-4">
                    <span class="text-red"><b>Cheque Amount: </b><span id="chAmt"></span></span>
                </div>
                <div class="col-md-4">
                    <span class="text-red"><b>Balance Amount to Enter: </b><span id="balAmt"></span></span>
                </div>
            </div>
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">X</button> &nbsp;
          <!--<button class="btn btn-primary pull-right scrollTopBtn"> ^ </button>&nbsp;-->
          
      </div>

      <div class="modal-body">
          
          <div class="card">
          <form id="chequeDetailsForm">
               <div class="row">
                
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('cheque_amount', 'Amount:') !!}
                        {!! Form::text('cheque_amount[]', null, ['class' => 'form-control cheque_amount',
                        'placeholder' => 'Amount' ]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('cheque_date','Cheque Date:') !!}
                        {!! Form::date('cheque_date[]', null, ['class' => 'cheque_date form-control',
                        'placeholder' => __(
                        'lang_v1.date' ) ]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('cheque_bank', 'Bank:') !!}
                        {!! Form::text('bank_name[]', null, ['class' => 'cheque_bank form-control',
                        'placeholder' => 'Bank' ]); !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('cheque_number', 'Cheque Number:') !!}
                        {!! Form::text('cheque_number[]', null, ['class' => 'cheque_number form-control',
                        'placeholder' => 'Cheque Number' ]); !!}
                    </div>
                </div>
                
                <div class="col-md-1">
                    <a href="#" id="addRow" class="btn btn-success"><i class="fa fa-plus"></i></a>
                </div>
                
            </div>
                <div class="addedRows"></div>
            </form>
          </div>
          
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
      </div>

    </div>
  </div>
</div>

<script>
    $('.cheque_acc_id').change(function() {
        if($(this).val() == "{{$chequeId}}"){
            $('#cheques_details').removeAttr('hidden');
            $('.chequeRelated').removeAttr('hidden');
            $('.cheque_customer_id').attr('required',true);
            $('#cheque_date').attr('required',true);
            $('#cheque_bank').attr('required',true);
            $('#cheque_number').attr('required',true);
        }else{
            $('#cheques_details').attr('hidden',true);
            $('.chequeRelated').attr('hidden',true);
            
            $('.cheque_customer_id').removeAttr('required');
            $('#cheque_date').removeAttr('required');
            $('#cheque_bank').removeAttr('required');
            $('#cheque_number').removeAttr('required');
        }    
    });
    
    
    function updateModal(){
        $("#customerName").text($('.cheque_customer_id option:selected').text());
        
        var amount = 0;
        amount = $("#amount").val();
        var added = 0;
        $("input[name='cheque_amount[]']").each(function() {
          if(parseFloat($(this).val())){
            added += parseFloat($(this).val());  
          }
          
        });
        
        var bal = amount - added;
        
        $("#chAmt").text(added);
        $("#balAmt").text(bal);
        
    }
    
    
    
    function popupModal(){
        if($(".cheque_customer_id").val() == "" || $(".cheque_customer_id").val() == "undefined" || !$(".cheque_customer_id").val()){
            toastr.error("Please select a customer! ");
        }else{
           $("#viewCheques").modal('show'); 
        }
        
    }
    
    function calculateTotals(){
        var amount = 0;
        amount = $("#amount").val();
        var added = 0;
        $("input[name='cheque_amount[]']").each(function() {
          if(parseFloat($(this).val())){
            added += parseFloat($(this).val());  
          }
          
        });
        
        var bal = amount - added;
        
        $("#addedTotal").text(added);
        $("#balTotal").text(bal);
        
        if(bal > 0 || bal < 0) {
            $('#saveForm').hide();
        }else{
            $('#saveForm').show();
        }
        
    }
    
    
    
    $("#amount").blur(function() {
        if($('.cheque_acc_id').val() == "{{$chequeId}}"){
            calculateTotals();
            popupModal();
        }
    });
    
    
    $(".cheque_amount").blur(function() {
        updateModal();
    });
    
    
    $('#viewCheques').on('show.bs.modal', function (e) {
        updateModal();
    });
    
    
    $('#viewCheques').on('hidden.bs.modal', function () {
      calculateTotals();
    });
    
    
    function addchequeRow(){
        var html = "";
        
        
        html += "<div class='row'> \
                <div class='col-md-3'> \
                    <div class='form-group'> \
                        <label for='cheque_amount'>Amount:</label> \
                        <input class='form-control cheque_amount' type='text' name='cheque_amount[]' placeholder='Amount' /> \
                    </div> \
                </div> \
                <div class='col-md-3'> \
                    <div class='form-group'> \
                        <label for='cheque_date'>Cheque Date:</label> \
                        <input class='cheque_date form-control' type='date' name='cheque_date[]' placeholder='Date' /> \
                    </div> \
                </div> \
                <div class='col-md-3'> \
                    <div class='form-group'> \
                        <label for='bank_name'>Bank:</label> \
                        <input class='cheque_bank form-control' type='text' name='bank_name[]' placeholder='Bank' /> \
                    </div> \
                </div> \
                <div class='col-md-2'> \
                    <div class='form-group'> \
                        <label for='cheque_number'>Cheque Number:</label> \
                        <input class='cheque_number form-control' type='text' name='cheque_number[]' placeholder='Cheque Number' /> \
                    </div> \
                </div> \
                <div class='col-md-1'> \
                    <a href='#' class='btn btn-danger removeRow'><i class='fa fa-minus'></i></a>\
                </div>\
            </div>";

                
            $(".addedRows").append(html);
            $(".select2").select2();
    }
    
    $(document).on('click', '.removeRow', function() { 
        $(this).closest('.row').remove();
    });
    
    $(document).on('click', '#addRow', function() {
        addchequeRow(); 
    });
    
    $('#account_settings_add_form').on('submit', function(e) {
        e.preventDefault();
        
        if($('.cheque_acc_id').val() == "{{$chequeId}}"){
            var chequeForm = $("#chequeDetailsForm").serialize();
        
            const params = new URLSearchParams(chequeForm);
    
            // create an empty object to store the data
            const formData = {};
            
            // loop through the parameter entries and populate the formData object
            for (const [key, value] of params.entries()) {
              const match = key.match(/^(.+)\[\]$/);
              if (match) {
                const name = match[1];
                if (!formData[name]) {
                  formData[name] = [];
                }
                formData[name].push(value);
              } else {
                formData[key] = value;
              }
            }
            
            const hasEmptyValue = Object.values(formData).some(value => {
              if (Array.isArray(value)) {
                return value.some(item => item === '');
              }
              return false;
            });
            
            if (hasEmptyValue) {
                toastr.error("Fill all fields!");
                calculateTotals();
                popupModal();
            } else {
                $("#cheque_amount").val(formData['cheque_amount']);
                $("#cheque_date").val(formData['cheque_date']);
                $("#bank_name").val(formData['bank_name']);
                $("#cheque_number").val(formData['cheque_number']);
                
                $('#account_settings_add_form')[0].submit();
                
            }
        }else{
           $('#account_settings_add_form')[0].submit(); 
        }
        
        
    });
    
    
</script>