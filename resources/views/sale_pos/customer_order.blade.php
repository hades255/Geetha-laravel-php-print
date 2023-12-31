@extends('layouts.app')
@section('title', __( 'lang_v1.list_orders'))
@section('content')



<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">@lang('lang_v1.list_orders')</h4>
                <ul class="breadcrumbs pull-left" style="margin-top: 15px">
                    <li><a href="#">Sales</a></li>
                    <li><span>@lang('lang_v1.list_orders')</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content main-content-inner no-print">
    @component('components.widget', ['class' => 'box-primary', 'date'=>''])
        @slot('tool')
            {{-- <div class="box-tools">
                <a class="btn btn-block btn-primary" href="{{action('SellPosController@create')}}">
                <i class="fa fa-plus"></i> @lang('messages.add')</a>
            </div> --}}
        @endslot
        <div class="form-group">
            <div class="input-group">
              <button type="button" class="btn btn-primary" id="daterange-btn">
                <span>
                  <i class="fa fa-calendar"></i> Filter By Date
                </span>
                <i class="fa fa-caret-down"></i>
              </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped ajax_view" id="sell_table">
                <thead>
                    <tr>
                        <th>@lang('messages.date')</th>
                        <th>@lang('purchase.ref_no')</th>
                        <th>@lang('sale.customer_name')</th>
                        <th>@lang('sale.location')</th>
                        <th>@lang('lang_v1.order_status')</th>
                        <th>@lang('messages.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endcomponent
</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
$(document).ready( function(){
    sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[0, 'desc']],
        ajax: '/sales/customer/orders?is_quotation=1&customer_order=1',
        columnDefs: [ {
            "targets": 4,
            "orderable": false,
            "searchable": false
        } ],
        columns: [
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'invoice_no', name: 'invoice_no'},
            { data: 'name', name: 'contacts.name'},
            { data: 'business_location', name: 'bl.name'},
            { data: 'order_status', name: 'order_status'},
            { data: 'action', name: 'action'}
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#purchase_table'));
        }
    });
    //Date range as a button
    $("#report_date_range").text("Date Range: "+ $('#daterange-btn span').text());
    $('#daterange-btn').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#daterange-btn span').html(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sell_table.ajax.url( '/sales/customer-orders?is_quotation=1&customer_order=1&start_date=' + start.format('YYYY-MM-DD') +
                '&end_date=' + end.format('YYYY-MM-DD') ).load();
            $("#report_date_range").text("Date Range: "+ $('#daterange-btn span').text());
        }
    );
    $('#daterange-btn').on('cancel.daterangepicker', function(ev, picker) {
        sell_table.ajax.url( '/sales/customer-orders?is_quotation=1&customer_order=1').load();
        $('#daterange-btn span').html('<i class="fa fa-calendar"></i> Filter By Date');
        $("#report_date_range").text("Date Range: "+ $('#daterange-btn span').text());
    });
});
</script>
	
@endsection