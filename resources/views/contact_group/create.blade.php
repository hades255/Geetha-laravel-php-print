<div class="modal-dialog" role="document" style="width: 35%;">
    <div class="modal-content">

        {!! Form::open(['url' => action('ContactGroupController@store'), 'method' => 'post', 'id' => 'contact_group_add_form' ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang( 'lang_v1.contact_group' )</h4>
        </div>
        <div class="modal-body">
            
            <div class="form-group">
                {!! Form::label('type', 'Contact Group Type:') !!}
                {!! Form::select('type',$types, !empty($type) ? $type : null, ['class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                {!! Form::label('name', __( 'lang_v1.contact_group_name' ) . ':*') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.contact_group_name' ) ]); !!}
            </div>

            <div class="form-group hide-supplier">
                {!! Form::label('price_calculation_type', 'Price Calculation Type:') !!}
                {!! Form::select('price_calculation_type',['percentage' => __('lang_v1.percentage'), 'selling_price_group' => __('lang_v1.selling_price_group')], 'percentage', ['class' => 'form-control']); !!}
            </div>

            <div class="form-group percentage-field hide-supplier">
                {!! Form::label('amount', 'Calculation Percentage:') !!}
                {{--                @show_tooltip(__('lang_v1.tooltip_calculation_percentage'))--}}
                {!! Form::text('amount', null, ['class' => 'form-control input_number','placeholder' => __( 'Calculation Percentage')]); !!}
            </div>

            <div class="form-group selling_price_group-field hide hide-supplier">
                {!! Form::label('selling_price_group_id', 'Selling Price Group:') !!}
                {!! Form::select('selling_price_group_id', $price_groups, null, ['class' => 'form-control']); !!}
            </div>

            {{--      <div class="form-group">--}}
            {{--        {!! Form::label('amount', __( 'lang_v1.calculation_percentage' ) . ':') !!}--}}
            {{--        @if(!empty($help_explanations['calculation_percentage'])) @show_tooltip($help_explanations['calculation_percentage']) @endif--}}
            {{--        {!! Form::text('amount', null, ['class' => 'form-control input_number','placeholder' => __( 'lang_v1.calculation_percentage')]); !!}--}}
            {{--      </div>--}}

            <div class="form-group hide-supplier">
                {!! Form::label('name', __( 'lang_v1.account_type' ) . ':') !!}
                <select name="account_type_id" class="form-control select2" id="changeAccountSelect">
                    <option value="">@lang( 'lang_v1.account_type' )</option>
                    @foreach($allAccountsType as $accountType)
                        <option value="{{ $accountType->id }}" {{($type == "customer" && $accountType->id == 3) ? 'selected' : ''}} {{($type != "customer" && $accountType->id == 4) ? 'selected' : ''}}>{{ $accountType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group hide-supplier">
                @if($type == "supplier")
                    {!! Form::label('name', __( 'lang_v1.interest_expense_account' ) . ':') !!}
                @else
                    {!! Form::label('name', __( 'lang_v1.interest_income_account' ) . ':') !!}
                @endif
                <select name="interest_account_id" class="form-control select2" id="AccountName" >
                    <option value="">@lang( 'lang_v1.account' )</option>
                    @foreach($allAccounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
@if($type == "supplier")
    <script>
        $(".hide-supplier").hide();
    </script>
@else
    <script>
        $(".hide-supplier").show();
    </script>
@endif
<script>
    $("#changeAccountSelect").change(function () {
        var typeId = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{url('fetch/AccountName')}}",
            data: {type_id: typeId, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                $("#AccountName").html('<option value="">Account</option>');
                $.each(data.accounts, function (key, value) {
                    $("#AccountName").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    })
    
    $("#type").change(function () {
        var typeId = $(this).val();
        
        if(typeId == 'supplier'){
            $(".hide-supplier").hide();
        }else{
            $(".hide-supplier").show();
        }
        
    })
</script>
