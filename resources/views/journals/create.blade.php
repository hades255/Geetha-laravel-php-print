@php

use App\Account;
$cash_account_id = Account::getAccountByAccountName('Cash')->id;

@endphp

<div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('account.add_journal')</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['url' => action('JournalController@store'), 'method' => 'post' ]) !!}
            <input type="hidden" id="index" name="index" value="1">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('journal_id', __('account.journal_no')) !!}
                            {!! Form::text('journal_id', $journal_id, ['class' => 'form-control
                            journal_id',
                            'requried', 'readonly'])
                            !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('date', __('account.date')) !!}
                            {!! Form::text('date', null, ['class' => 'form-control
                            journal_date',
                            'requried'])
                            !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('select_location', __('account.select_location')) !!}
                            {!! Form::select('location_id', $locations, $default_location_id, [ 'class' =>
                            'form-control select2','style' => 'width:100%', 'id' => 'location_id',
                            'requried' , 'placeholder'
                            =>
                            'Please select']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('is_opening_balance', __('account.opening_balance')) !!}
                            {!! Form::select('is_opening_balance',['yes' => 'Yes', 'no' => 'No'], null, [ 'class' =>
                            'form-control select2','style' => 'width:100%', 'id' => 'is_opening_balance',
                            'requried' , 'placeholder', 'disabled'
                            =>
                            'Please select']) !!}
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('note', __('account.note')) !!}
                            {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 2, 'cols' => 10,])
                            !!}
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('show_in_ledger', __('account.show_in_ledger')) !!}
                            {!! Form::select('show_in_ledger',['no' => 'No need to show', 'customer' => 'Customer Ledger','supplier' => 'Supplier Ledger'], null, [ 'class' =>
                            'form-control','style' => 'width:100%', 'id' => 'show_in_ledger',
                             'placeholder'
                            =>
                            'Please select']) !!}
                        </div>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-md-12" id="show_in_fields" hidden>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('show_in', __('account.show_in')) !!}
                                {!! Form::select('show_in',['credit' => 'Credit', 'debit' => 'Debit'], null, [ 'class' =>
                                'form-control select2','style' => 'width:100%', 'id' => 'show_in',
                                 'placeholder'
                                =>
                                'Please select']) !!}
                            </div>
                        </div>
                        
                        <div class="col-md-6" hidden id="supplier_show_in_fields">
                            <div class="form-group">
                                {!! Form::label('supplier_show_in', __('lang_v1.supplier')) !!}
                                {!! Form::select('supplier_show_in',$suppliers, null, [ 'class' =>
                                'form-control select2','style' => 'width:100%', 'id' => 'supplier_show_in',
                                 'placeholder'
                                =>
                                'Please select']) !!}
                            </div>
                        </div>
                        
                        <div class="col-md-6" hidden id="customer_show_in_fields">
                            <div class="form-group">
                                {!! Form::label('customer_show_in', __('lang_v1.customer')) !!}
                                {!! Form::select('customer_show_in',$customers, null, [ 'class' =>
                                'form-control select2','style' => 'width:100%', 'id' => 'customer_show_in',
                                 'placeholder'
                                =>
                                'Please select']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row journal_row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('account_type_id', __('account.select_account_type')) !!}
                            {!! Form::select('', $account_types, null, ['id' => 'account_type0', 'class' =>
                            'form-control select2 account_type_ids','style' => 'width:100%',
                            'requried' , 'placeholder'
                            =>
                            'Please select']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('account_id', __('account.select_account')) !!}
                            {!! Form::select('', [], null, ['id' => 'account_id0', 'class' =>
                            'form-control select2 account_ids','style' => 'width:100%',
                            'requried' , 'placeholder'
                            =>
                            'Please select']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('amount', __('account.debit_amount')) !!}
                            {!! Form::text('', null, ['id' => "debit0", 'class' => 'debit-top form-control debit_amount0',
                             'placeholder' => __('account.amount')]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('amount', __('account.credit_amount')) !!}
                            {!! Form::text('', null, [ 'id'=> 'credit0','class' => 'credit-top form-control credit_amount0',
                             'placeholder' => __('account.amount')]) !!}
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-xs btn-primary add_row"
                            style="margin-top: 7px;">+</button>
                    </div>

                    
                </div>
                <div class="row journal_row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::select('', $account_types, null, ['id' => 'account_type1',  'class' =>
                            'form-control select2 account_type_ids','style' => 'width:100%',
                            'requried' , 'placeholder'
                            =>
                            'Please select']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::select('', [], null, ['id' => 'account_id1',  'class' =>
                            'form-control select2 account_ids','style' => 'width:100%',
                            'requried' , 'placeholder'
                            =>
                            'Please select']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::text('', null, ['id' => 'debit1',  'class' => 'debit-top form-control debit_amount1',
                            'placeholder' => __('account.amount')]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::text('', null, [ 'id'=> 'credit1','class' => 'credit-top form-control credit_amount1',
                             'placeholder' => __('account.amount')]) !!}
                        </div>
                    </div>


                    <div class="col-md-2">
                        <button type="button" class="btn btn-xs btn-primary add_row_create" data-index="1"
                            style="margin-top: 7px;">Add</button>
                    </div>
                </div>
                <div class="row journal_rows"></div>
                <div class="row">
                    <div class="col-md-6">
                    <h4>@lang('account.total')</h4>
                    </div>
                    <div class="col-md-2">
                        {!! Form::text('debit_total_top', null, [ 'class' => 'form-control debit_total_top', 'readonly', 'style' =>
                        'width:100%;'
                        ]) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::text('credit_total_top', null, [ 'class' => 'form-control credit_total_top', 'readonly', 'style'
                        => 'width:100%;'
                        ]) !!}
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="journal_details">
                        <thead>
                            <tr>
                                <th>@lang('account.account')</th>
                                <th>@lang('account.debit')</th>
                                <th>@lang('account.credit')</th>
                                <th>@lang('account.show_in_ledger')</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                        </tbody>
            
                    </table>
                </div>
                
            </div>


            <div class="modal-footer">
                <div class="col-md-6">
                    <h4>@lang('account.total')</h4>
                </div>
                <div class="col-md-2">
                    {!! Form::text('debit_total', null, [ 'class' => 'form-control debit_total', 'readonly', 'style' =>
                    'width:100%;',
                    'required']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::text('credit_total', null, [ 'class' => 'form-control credit_total', 'readonly', 'style'
                    => 'width:100%;',
                    'required']) !!}
                </div>

                <button type="submit" class="btn btn-primary add_btn">@lang( 'messages.add' )</button>

                <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
            </div>

            {!! Form::close() !!}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    <script>
        $('.journal_date').datepicker("setDate", new Date());
        $('.select2').select2();
        $('.add_btn').attr('disabled', true);

        $('body').on('click', '.remove_row', function(e) {
            e.preventDefault();
            $(this).closest('div.row').remove();
            calculate_total();
        });
        
        var curr = 0;
        
        
        $('.add_row_create').on('click', function() {
            var curr = parseInt($("#index").val()) || 0; // Get the current index from the input
            console.log(curr);
        
            var rowsHtml = ''; // Variable to store the HTML for the new rows
        
            for (var i = 0; i < curr + 1; i++) {
                var accountType = $(`#account_type${i}`).val();
                var account = $(`#account_id${i}`).val();
                var debit = parseFloat($(`#debit${i}`).val()) || "";
                var credit = parseFloat($(`#credit${i}`).val()) || "";
        
                if (accountType && account && (debit !== "" || credit !== "")) {
                    rowsHtml += `
                        <tr>
                            <td>${$(`#account_id${i} option:selected`).text()}</td>
                            <td>${debit}</td>
                            <td>${credit}</td>
                            <td>${$('#show_in_ledger option:selected').text()}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-danger remove_row">-</button>
                            </td>
                            <input type="hidden" name="journal[${i}][account_type_id]" value="${accountType}">
                            <input type="hidden" name="journal[${i}][account_id]" value="${account}">
                            <input type="hidden" name="journal[${i}][credit_amount]" value="${credit}" class="credit">
                            <input type="hidden" name="journal[${i}][debit_amount]" value="${debit}" class="debit">
                        </tr>
                    `;
                }
        
                // Reset journal row values
                $(`#account_type${i}`).val('').trigger('change');
                $(`#account_id${i}`).val('').trigger('change');
                $(`#debit${i}`).val('');
                $(`#credit${i}`).val('');
            }
        
            // Append the new rows to the table
            $('#journal_details tbody').append(rowsHtml);
        
            calculate_total();
            calculate_total_top();
        });

        
        
        // $('.add_row_create').on('click', function() {
            
        //     console.log($("#index").val());
            
        //     var accountType0 = $('#account_type0').val();
        //     var account0 = $('#account_id0').val();
        //     var debit0 = parseFloat($('#debit0').val()) || "";
        //     var credit0 = parseFloat($('#credit0').val()) || "";
            
            
        //     if (accountType0 && account0 && (debit0 !== "" || credit0 !== "")) {
                
        //         $('#journal_details tbody').append(`
        //             <tr>
        //                 <td>${$('#account_id0 option:selected').text()}</td>
        //                 <td>${debit0}</td>
        //                 <td>${credit0}</td>
        //                 <td>${$('#show_in_ledger option:selected').text()}</td>
        //                 <td>
        //                     <button type="button" class="btn btn-xs btn-danger remove_row">-</button>
        //                 </td>
        //                 <input type="hidden" name="journal[${curr}][account_type_id]" value="${accountType0}">
        //                 <input type="hidden" name="journal[${curr}][account_id]" value="${account0}">
        //                 <input type="hidden" name="journal[${curr}][credit_amount]" value="${credit0}" class="credit">
        //                 <input type="hidden" name="journal[${curr}][debit_amount]" value="${debit0}" class="debit">
        //             </tr>
        //         `);
                
                
        //         // Reset journal row values
        //         $('#account_type0').val('').trigger('change');
        //         $('#account_id0').val('').trigger('change');
        //         $('#debit0').val('');
        //         $('#credit0').val('');
        //     }
            
        //     var accountType1 = $('#account_type1').val();
        //     var account1 = $('#account_id1').val();
        //     var debit1 = parseFloat($('#debit1').val()) || "";
        //     var credit1 = parseFloat($('#credit1').val()) || "";

        //     if (accountType1 && account1 && (debit1 !== "" || credit1 !== "")) {
        //         $('#journal_details tbody').append(`
        //             <tr>
        //                 <td>${$('#account_id1 option:selected').text()}</td>
        //                 <td>${debit1}</td>
        //                 <td>${credit1}</td>
        //                 <td>${$('#show_in_ledger option:selected').text()}</td>
        //                 <td>
                            
        //                 </td>
        //                 <input type="hidden" name="journal[${curr+1}][account_type_id]" value="${accountType1}">
        //                 <input type="hidden" name="journal[${curr+1}][account_id]" value="${account1}">
        //                 <input type="hidden" name="journal[${curr+1}][credit_amount]" value="${credit1}" class="credit">
        //                 <input type="hidden" name="journal[${curr+1}][debit_amount]" value="${debit1}" class="debit">
        //             </tr>
        //         `);
        //         // Reset journal row values
        //         $('#account_type1').val('').trigger('change');
        //         $('#account_id1').val('').trigger('change');
        //         $('#debit1').val('');
        //         $('#credit1').val('');
        //     }
            
        //     curr += 2;
            
        //     calculate_total();
        //     calculate_total_top();

        // });
        
        $(document).on('click', '.remove_row', function() {
            $(this).closest('tr').next('tr').remove();
            $(this).closest('tr').remove();
            calculate_total();
            calculate_total_top();
        });
        


        $('body').on('change', '.debit-top, .credit-top', function() {
            console.log("here");
        
            if ($('.debit_amount0').val()) {
                $('.credit_amount0').attr('disabled', 'disabled');
            } else if ($('.credit_amount0').val()) {
                $('.debit_amount0').attr('disabled', 'disabled');
            } else {
                $('.debit_amount0').attr('disabled', false);
                $('.credit_amount0').attr('disabled', false);
            }
            calculate_total();
            calculate_total_top();
        });

        // $('.debit_amount1, .credit_amount1').change(function(){
        //     if($('.debit_amount1').val()){
        //         $('.credit_amount1').attr('disabled', 'disabled');
        //     }
        //     else if($('.credit_amount1').val()){
        //         $('.debit_amount1').attr('disabled', 'disabled');
        //     }else{
        //         $('.debit_amount1').attr('disabled', false);
        //         $('.credit_amount1').attr('disabled', false);
        //     }

        //     calculate_total();
        //     calculate_total_top();
        // })
        
        $('body').on('click', '.add_row', function(e) {
            e.preventDefault();
            index = parseInt($('#index').val()) +1 ;
            debit_account_option = $('.debit_amount0').children();
            credit_account_option = $('.credit_amount0').children();
            $('#index').val(index);
            $.ajax({
                method: 'get',
                url: "{{action('JournalController@getRow')}}",
                data: { index:index },
                type : 'html',
                success: function(result) {
                    $('.journal_rows').append(result);
                },
            }).then(function(){
                $('body').find('.journal_date'+index).datepicker("setDate", new Date());
                $('body').find('.debit_account_option'+index).select2();
                $('body').find('.credit_account_option'+index).select2();
            });  
        });

        $('body').on('click', '.remove_row', function(e) {
            e.preventDefault();
            $(this).closest('div.row').remove();
            calculate_total();
        });
        
        
        
        function calculate_total_top() {
            let debit = 0;
            let credit = 0;
            $('.debit-top').each(function () {
                if($(this).val() != ''){
                    debit += parseFloat($(this).val());
                }
                
            });
            $('.credit-top').each(function () {
                if($(this).val() != ''){
                    credit += parseFloat($(this).val());
                }
            });

            $('.debit_total_top').val(debit);
            $('.credit_total_top').val(credit);

            if(debit == credit){
                $('.add_row_create').attr('disabled', false);
            }else{
                $('.add_row_create').attr('disabled', true);
            }
        }

        function calculate_total() {
            let debit = 0;
            let credit = 0;
            $('.debit').each(function () {
                if($(this).val() != ''){
                    debit += parseFloat($(this).val());
                }
                
            });
            $('.credit').each(function () {
                if($(this).val() != ''){
                    credit += parseFloat($(this).val());
                }
            });

            $('.debit_total').val(debit);
            $('.credit_total').val(credit);

            if(debit == credit){
                $('.add_btn').attr('disabled', false);
            }else{
                $('.add_btn').attr('disabled', true);
            }
        }

        $(document).on('change', '.account_type_ids',function () {
            let account_type_id = $(this).val();
            var this_row = $(this).closest('.journal_row');
            $.ajax({
                method: 'get',
                url: '/accounting-module/journals/get-account-dropdown-by-type/'+account_type_id,
                contentType: 'html',
                data: {  },
                success: function(result) {
                    $(this_row).find('.account_ids').empty().append(result);
                },
            });
        })
        
        $(document).on('change', '#is_opening_balance',function () {
            if($(this).val() === 'yes'){
                $('#note').attr('required', true);
            }else{
                $('#note').attr('required', false);
            }
        });
        
        $(document).on('change', '#show_in_ledger',function () {
            if($(this).val() === 'no'){
                $('#show_in_fields').attr('hidden', true);
                
                $('#customer_show_in').attr('required', false);
                $('#supplier_show_in').attr('required', false);
            }else{
                if($(this).val() === "customer"){
                    $('#customer_show_in').attr('required', true);
                    $('#supplier_show_in').attr('required', false);
                    
                    $('#customer_show_in_fields').attr('hidden', false);
                    $('#supplier_show_in_fields').attr('hidden', true);
                }else{
                    $('#customer_show_in').attr('required', false);
                    $('#supplier_show_in').attr('required', true);
                    
                    $('#customer_show_in_fields').attr('hidden', true);
                    $('#supplier_show_in_fields').attr('hidden', false);
                }
                $('#show_in_fields').attr('hidden', false);
            }
        });
        
        $(document).on('change', '.account_ids',function () {
            var accid = $(this).val();
            var $row = $(this).closest('.row');
            var paid = $row.find('.credit').val()
            
            
            if(accid == "{{$cash_account_id}}"){
                $.ajax({
                   method: 'GET',
                    url: '/accounting-module/get-account-balance/' + accid,
                   success: function(result) {
                    
                    if(parseFloat(paid) > parseFloat(result.balance) && result.balance != null){
                        swal({
                            title: "Credit amount can't be more than account balance",
                            icon: "error",
                            buttons: true,
                            dangerMode: true,
                        });
                        
                        $('.add_btn').attr('disabled', true);
                      } else {
                        $('.add_btn').attr('disabled', false);
                      }
                   }
                });
            }
             
        });
        
        $(document).on('change', '.credit',function () {
            var paid = $(this).val();
            var $row = $(this).closest('.row');
            var accid = $row.find('.account_ids').val()
            
            
            if(accid == "{{$cash_account_id}}"){
                $.ajax({
                   method: 'GET',
                    url: '/accounting-module/get-account-balance/' + accid,
                   success: function(result) {
                    
                    if(parseFloat(paid) > parseFloat(result.balance) && result.balance != null){
                        swal({
                            title: "Credit amount can't be more than account balance",
                            icon: "error",
                            buttons: true,
                            dangerMode: true,
                        });
                        
                        $('.add_btn').attr('disabled', true);
                      } else {
                        $('.add_btn').attr('disabled', false);
                      }
                   }
                });
            }
             
        });

    </script>