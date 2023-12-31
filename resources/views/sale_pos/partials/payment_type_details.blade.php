@php
	$business_id = request()->session()->get('business.id');
	$card_types = [];
	$card_group = App\AccountGroup::where('business_id', $business_id)->where('name', 'Card')->first();
	if (!empty($card_group)) {
		$card_types = App\Account::where('business_id', $business_id)->where('asset_type', $card_group->id)->where(DB::raw("REPLACE(`name`, '  ', ' ')"), '!=', 'Cards (Credit Debit) Account')->pluck('name', 'id');
	}

@endphp
<div class="payment_details_div @if( $payment_line['method'] !== 'card' ) {{ 'hide' }} @endif" data-type="card" >
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label("card_number_$row_index", __('lang_v1.card_no')) !!}
			{!! Form::text("payment[$row_index][card_number]", $payment_line['card_number'], ['class' => 'form-control', 'placeholder' => __('lang_v1.card_no'), 'id' => "card_number_$row_index", !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label("card_holder_name_$row_index", __('lang_v1.card_holder_name')) !!}
			{!! Form::text("payment[$row_index][card_holder_name]", $payment_line['card_holder_name'], ['class' => 'form-control', 'placeholder' => __('lang_v1.card_holder_name'), 'id' => "card_holder_name_$row_index", !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label("card_transaction_number_$row_index",__('lang_v1.card_transaction_no')) !!}
			{!! Form::text("payment[$row_index][card_transaction_number]",$payment_line['card_transaction_number'], ['class' => 'form-control', 'placeholder' => __('lang_v1.card_transaction_no'), 'id' => "card_transaction_number_$row_index", !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label("card_type_$row_index", __('lang_v1.card_type')) !!}
			{!! Form::select("payment[$row_index][card_type]",  $card_types , $payment_line['card_type'],['class' => 'form-control', 'id' => "card_type_$row_index", 'placeholder' => __('lang_v1.please_select'), !empty($edit) ? 'disabled' : '' ]); !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label("card_month_$row_index", __('lang_v1.month')) !!}
			{!! Form::text("payment[$row_index][card_month]",$payment_line['card_month'], ['class' => 'form-control', 'placeholder' => __('lang_v1.month'),
			'id' => "card_month_$row_index" , !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label("card_year_$row_index", __('lang_v1.year')) !!}
			{!! Form::text("payment[$row_index][card_year]",$payment_line['card_year'], ['class' => 'form-control', 'placeholder' => __('lang_v1.year'), 'id' => "card_year_$row_index", !empty($edit) ? 'disabled' : '' ]); !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label("card_security_$row_index",__('lang_v1.security_code')) !!}
			{!! Form::text("payment[$row_index][card_security]", $payment_line['card_security'], ['class' => 'form-control', 'placeholder' => __('lang_v1.security_code'), 'id' => "card_security_$row_index", !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<div class="payment_details_div  @if( $payment_line['method'] !== 'cheque' && empty($edit) ) {{ 'hide' }} @endif" data-type="cheque">
	@if(!empty($payment->cheque_date) && !empty($payment->method) && ($payment->method == 'bank_transfer' || $payment->method == 'cheque'))
	<input type="hidden" name="payment_edit_cheque" id="payment_edit_cheque" value="{{@format_date($payment->cheque_date)}}" , @if(!empty($edit)) {{ 'disabled' }} @endif > <!-- used for set cheque date to current date if empty in app.js line 1533 -->
	@endif
	
	@if(!empty($edit))
	@if(!empty($payment->method) && ($payment->method == 'bank_transfer' || $payment->method == 'cheque'))
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label("cheque_numbe",__('lang_v1.cheque_no')) !!}
			{!! Form::text("payment",!empty($payment->cheque_number)?$payment->cheque_number: $payment_line['cheque_number'], ['class' => 'form-control', 'placeholder' => __('lang_v1.cheque_no'), 'id' => "cheque_number",'disabled']); !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label("cheque_date_$row_index",__('lang_v1.cheque_date')) !!}
			{!! Form::text("payment",!empty($payment->cheque_date)?$payment->cheque_date: '', ['class' => 'form-control cheque_date', 'placeholder' => __('lang_v1.cheque_date'),'disabled']); !!}
		</div>
	</div>
	@endif
	@endif
	
	
	
	@if(empty($edit))
	<div class="col-md-6">
	     <div class="form-group">
              {!! Form::label('transaction_date_range_cheque_deposit', __('report.date_range') . ':') !!}
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {!! Form::text('transaction_date_range_cheque_deposit', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range'), !empty($edit) ? 'disabled' : '']) !!}
              </div>
        </div>
	</div>
	<div class="col-md-12">
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
	</div>
	@endif
	
</div>

<div class="payment_details_div @if( $payment_line['method'] !== 'custom_pay_1' ) {{ 'hide' }} @endif" data-type="custom_pay_1" >
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label("transaction_no_1_$row_index", __('lang_v1.transaction_no')) !!}
			{!! Form::text("payment[$row_index][transaction_no_1]",!empty($payment->transaction_no_1)?$payment->transaction_no_1: $payment_line['transaction_no'], ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no'), 'id' => "transaction_no_1_$row_index", !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line['method'] !== 'custom_pay_2' ) {{ 'hide' }} @endif" data-type="custom_pay_2" >
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label("transaction_no_2_$row_index", __('lang_v1.transaction_no')) !!}
			{!! Form::text("payment[$row_index][transaction_no_2]", !empty($payment->transaction_no_2)?$payment->transaction_no_2:$payment_line['transaction_no'], ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no'), 'id' => "transaction_no_2_$row_index", !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line['method'] !== 'custom_pay_3' ) {{ 'hide' }} @endif" data-type="custom_pay_3" >
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label("transaction_no_3_$row_index", __('lang_v1.transaction_no')) !!}
			{!! Form::text("payment[$row_index][transaction_no_3]", !empty($payment->transaction_no_3)?$payment->transaction_no_3:$payment_line['transaction_no'], ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no'), 'id' => "transaction_no_3_$row_index", !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
</div>

<script>
       
</script>
