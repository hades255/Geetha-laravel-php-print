@php
use App\Account;
$business_id = request()->session()->get('user.business_id');
$cpc_accounts = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')
            ->where('accounts.business_id', $business_id)
            ->where('account_groups.name', 'CPC')
            ->pluck('accounts.name', 'accounts.id');
$cash_account_id = Account::getAccountByAccountName('Cash')->id;

if(!isset($payment)){
$payment = json_encode([]);
}
@endphp

<div class="row payment-row">
	<input type="hidden" class="payment_row_index" value="{{ $row_index}}">
	@php
	$col_class = 'col-md-3';
	if(!empty($accounts)){
	$col_class = 'col-md-3';
	}
	@endphp
	<div class="{{$col_class}}">
		<div class="form-group">
			{!! Form::label("amount_$row_index" ,__('sale.amount') . ':*') !!}
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-money"></i>
				</span>
				{!! Form::text("payment[$row_index][amount]", @num_format(!empty($payment->amount)?str_replace(',', ''
				,$payment->amount):$payment_line['amount']), ['class' => 'form-control payment-amount input_number',
				'required', 'id' => "amount_$row_index", 'placeholder' => __('sale.amount'), !empty($edit) ? 'disabled' : '']); !!}
			</div>
		</div>
	</div>
	<div class="{{$col_class}}">
		<div class="form-group">
			{!! Form::label("method_$row_index" , __('lang_v1.payment_method') . ':*') !!}
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-money"></i>
				</span>
				{!! Form::select("payment[$row_index][method]", $payment_types, !empty($payment->method)? ($payment->method == 'cash' ? $cash_account_id : $payment->method): null, ['class' => 'form-control
				payment_types_dropdown select2', 'required', 'id' => "method_$row_index", 'style' => 'width:100%;',
				'placeholder' => __('messages.please_select'), !empty($edit) ? 'disabled' : '']); !!}
			</div>
		</div>
	</div>
	<div class="{{$col_class}} hide  account_module">
		<div class="form-group">
			{!! Form::label("account_$row_index" , __('lang_v1.payment_account') . ':') !!}
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-money"></i>
				</span>
				{!! Form::select("payment[$row_index][account_id]", [], !empty($payment->account_id)? $payment->account_id : $payment_line['account_id'] ?? null , ['class' =>
				'form-control account_id
				select2', 'placeholder' => __('lang_v1.please_select'), 'id' => "account_$row_index", 'style' =>
				'width:100%;', !empty($edit) ? 'disabled' : '']); !!}
			</div>
		</div>
	</div>
	
	<div class="col-md-6 hide  bank_transfer_fields">
	    <div class="col-md-6">
    		<div class="form-group">
    			{!! Form::label("cheque_numbe",__('lang_v1.cheque_no')) !!}
    			{!! Form::text("payment[$row_index][cheque_number]",!empty($payment->cheque_number)?$payment->cheque_number: $payment_line['cheque_number'], ['class' => 'form-control', 'placeholder' => __('lang_v1.cheque_no'), 'id' => "cheque_number"]); !!}
    		</div>
    	</div>
    	<div class="col-md-6">
    		<div class="form-group">
    			{!! Form::label("cheque_date_$row_index",__('lang_v1.cheque_date')) !!}
    			{!! Form::date("payment[$row_index][cheque_date]",!empty($payment->cheque_date)?$payment->cheque_date: '', ['class' => 'form-control cheque_date', 'placeholder' => __('lang_v1.cheque_date')]); !!}
    		</div>
    	</div>
	</div>
	
	
	

	@include('sale_pos.partials.payment_type_details', ['payment' => $payment,'edit' => !empty($edit) ? 'true' : ''])
	<div class="{{ $col_class }}">
		<div class="form-group">
			{!! Form::label("note_$row_index", __('sale.payment_note') . ':') !!}
			{!! Form::textarea("payment[$row_index][note]", !empty($payment->note)?$payment->note:$payment_line['note'],
			['class' => 'form-control', 'rows' => 3, 'id' => "note_$row_index", !empty($edit) ? 'disabled' : '']); !!}
		</div>
	</div>
</div>