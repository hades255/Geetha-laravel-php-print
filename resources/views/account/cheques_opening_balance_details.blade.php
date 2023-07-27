@php

use App\Transaction;
$business_id = request()->session()->get('user.business_id');

$banks = Transaction::where('transactions.type','cheque_opening_balance')
    ->where('transactions.business_id',$business_id)
    ->select('transaction_payments.bank_name')
    ->leftJoin('transaction_payments', 'transactions.id', '=', 'transaction_payments.transaction_id')
    ->distinct()
    ->pluck('bank_name','bank_name');
    
$cheque_nos = Transaction::where('transactions.type','cheque_opening_balance')
    ->where('transactions.business_id',$business_id)
    ->select('transaction_payments.cheque_number')
    ->leftJoin('transaction_payments', 'transactions.id', '=', 'transaction_payments.transaction_id')
    ->distinct()
    ->pluck('cheque_number','cheque_number');
    
$amounts = Transaction::where('transactions.type','cheque_opening_balance')
    ->where('transactions.business_id',$business_id)
    ->select('transaction_payments.amount')
    ->leftJoin('transaction_payments', 'transactions.id', '=', 'transaction_payments.transaction_id')
    ->distinct()
    ->pluck('amount','amount');



@endphp



<div class="row">
    <div class="col-md-12">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('cheques_ob_details_date_range', __('lang_v1.date_range').':') !!}
                {!! Form::text('cheques_ob_details_date_range', null, ['class' => 'form-control ', 'style' => 'width: 100%;']); !!}
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('cheques_ob_details_user_id', __('lang_v1.customer').':') !!}
                {!! Form::select('cheques_ob_details_user_id', $customers, null, ['class' => 'form-control
                select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('cheques_ob_details_cheque_no', __('lang_v1.cheque_no').':') !!}
                {!! Form::select('cheques_ob_details_cheque_no', $cheque_nos, null, ['class' => 'form-control
                select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('cheques_ob_details_amount', __('lang_v1.amount').':') !!}
                {!! Form::select('cheques_ob_details_amount', $amounts, null, ['class' => 'form-control
                select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        </div>
        <div class="col-md-12">
        
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('cheques_ob_details_bank', __('lang_v1.bank').':') !!}
                {!! Form::select('cheques_ob_details_bank', $banks, null, ['class' => 'form-control
                select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered" id="cheques_ob_details_table" style="width: 100%;">
            <thead>
                <tr>
                    <th>@lang( 'lang_v1.date' )</th>
                    <th>@lang( 'lang_v1.customer' )</th>
                    <th>@lang( 'lang_v1.cheque_number' )</th>
                    <th>@lang( 'lang_v1.amount' )</th>
                    <th>@lang( 'lang_v1.cheque_date' )</th>
                    <th>@lang( 'lang_v1.bank' )</th>
                    <th>@lang('lang_v1.action')</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>