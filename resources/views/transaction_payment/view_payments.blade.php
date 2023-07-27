@extends('layouts.app')
@section('title', 'Payment')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">

	<div class="box">
        <div class="box-body">
            	<table class="table table-bordered table-striped" id="trans_table">
            		<thead>
            			<tr>
            				<th>@lang( 'date' )</th>
            				<th>@lang( 'ref no' )</th>
            				<th>@lang( 'amount' )</th>
            				<th>@lang( 'note' )</th>
            			</tr>
            		</thead>
            	</table>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
    <script src="{{ asset('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js?v=' . $asset_v) }}"></script>
<script>

    $(document).ready(function(){
        $(".select2").select2();
    
        //$('#trans_table').DataTable();
        trans_table = $('#trans_table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: '{{action("TransactionPaymentController@getPaymentViewDatatable", $id)}}',
                data: function(d) {
                    //console.log(d);
                    // if ($('#payment_filter_date_range').val() && $('#payment_filter_date_range').length >0) {
                    //     if($('#payment_filter_date_range').data('daterangepicker'))
                    //         d.start_date = $('#payment_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    //     if($('#payment_filter_date_range').data('daterangepicker'))
                    //         d.end_date = $('#payment_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    // }
                    // d.receipt_no = $('#receipt_no').val();
                    // d.method = $('#payment_method').val();
                    // d.user_id = $('#user_id').val();
                    // d.payment_option = $('#on_account_of').val();
                    //alert();
                }
            },
            columns: [
                { data: 'paid_on', name: 'paid_on' },
                { data: 'payment_ref_no', name: 'payment_ref_no' },
                { data: 'amount', name: 'amount' },
                { data: 'note', name: 'note' },
            ],
            "fnDrawCallback": function (oSettings) {
                $('#total_payments').text(__number_f(sum_table_col($('#payments_table'), 'amount')));
            },
        });
    });
</script>