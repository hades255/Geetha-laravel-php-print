<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('AccountController@updateChequeOb',$account->id), 'method' => 'POST', 'id' =>
    'edit_cheque_ob_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.edit' )</h4>
    </div>

    <div class="modal-body">
      
      <div class="form-group">
        {!! Form::label('amount', __( 'account.amount' ) .":*") !!}
        {!! Form::text('amount', @num_format($account->amount), ['class' => 'form-control', 'required','placeholder'
        => __( 'account.amount' ) ]); !!}
      </div>
      
      <div class="form-group">
        {!! Form::label('bank_name', __( 'lang_v1.bank' ) .":*") !!}
        {!! Form::text('bank_name', $account->bank_name, ['class' => 'form-control', 'required','placeholder'
        => __( 'account.bank_name' ) ]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('cheque_number', __( 'lang_v1.cheque_no' ) .":*") !!}
        {!! Form::text('cheque_number', $account->cheque_number, ['class' => 'form-control', 'required','placeholder'
        => __( 'account.cheque_number' ) ]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('cheque_date', __( 'lang_v1.cheque_date' ) .":*") !!}
        {!! Form::date('cheque_date', $account->cheque_date, ['class' => 'form-control', 'placeholder' => __(
        'account.cheque_date' ) ]); !!}
      </div>
      
      <div class="form-group">
        {!! Form::label('customer', __( 'lang_v1.customer' ) .":*") !!}
        {!! Form::select('customer', $customers, $account->contact_id, ['class' =>
        'form-control select2', 'placeholder' => __(
        'lang_v1.please_select' ) ,'style' => 'width: 100%']); !!}
      </div>


    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    $(".select2").select2();
</script>
