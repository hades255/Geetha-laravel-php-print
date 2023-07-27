@extends('layouts.app')
@section('title', __('report.payment_status_report'))

@section('content')
<!-- Main content -->
<section class="content">

    <div class="row no-print">
        <div class="col-md-12">
            <div class="settlement_tabs no-print">
                <ul class="nav nav-tabs  no-print">
                    @can('purchase_payment_report.view')
                    <li class="active">
                        <a href="#purchase_payment_report" class="purchase_payment_report" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('report.purchase_payment_report')</strong>
                        </a>
                    </li>
                    @endcan

                    @can('sell_payment_report.view')
                    <li class="">
                        <a href="#sell_payment_report" class="sell_payment_report" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('report.sell_payment_report')</strong>
                        </a>
                    </li>
                    @endcan

                    @can('outstanding_received_report.view')
                    <li class="">
                        <a href="#outstanding_report" class="outstanding_report" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('report.outstanding_report')</strong>
                        </a>
                    </li>
                    @endcan

                    @can('aging_report.view')
                    <li class="">
                        <a href="#aging_report" class="aging_report" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('report.aging_report')</strong>
                        </a>
                    </li>
                    @endcan
                    
                     @can('aging_report.view')
                    <li class="">
                        <a href="#aging_report_total" class="aging_report_total" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('report.aging_report_total')</strong>
                        </a>
                    </li>
                    @endcan

                </ul>
                <div class="tab-content">
                    @can('purchase_payment_report.view')
                    <div class="tab-pane active" id="purchase_payment_report">
                        @include('report.purchase_payment_report')
                    </div>
                    @endcan

                    @can('sell_payment_report.view')
                    <div class="tab-pane" id="sell_payment_report">
                        @include('report.sell_payment_report')
                    </div>
                    @endcan

                    @can('outstanding_received_report.view')
                    <div class="tab-pane" id="outstanding_report">
                        @include('report.outstanding_report')
                    </div>
                    @endcan

                    @can('aging_report.view')
                    <div class="tab-pane" id="aging_report">
                        @include('report.aging_report')
                    </div>
                    @endcan
                    
                    @can('aging_report.view')
                    <div class="tab-pane" id="aging_report_total">
                        @include('report.aging_report_total')
                    </div>
                    @endcan
                    
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>

<script>
    //Date range as a button
    if ($('#outstanding_report_date_filter').length == 1) {
        $('#outstanding_report_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#outstanding_report_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            outstanding_report_table.ajax.reload();
        });
        $('#outstanding_report_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#outstanding_report_date_filter').val('');
            outstanding_report_table.ajax.reload();
        });
        $('#outstanding_report_date_filter').data('daterangepicker').setStartDate(moment().startOf('month'));
        $('#outstanding_report_date_filter').data('daterangepicker').setEndDate(moment().endOf('month'));
    }
    $(document).ready(function(){
        outstanding_report_table = $('#outstanding_report_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": "{{action('ReportController@getOutstandingReport')}}",
                "data": function ( d ) {
                    if($('#outstanding_report_date_filter').val()) {
                        var start = $('#outstanding_report_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#outstanding_report_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }
                    d.customer_id = $('#outstanding_customer_id').val();
                }
            },
            columnDefs: [ {
                "targets": [6],
                "orderable": false,
                "searchable": false
            } ],
            columns: [
                { data: 'paid_on', name: 'tp.paid_on'  },
                { data: 'name', name: 'contacts.name'},
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'final_total', name: 'final_total'},
                { data: 'total_paid', name: 'total_paid', "searchable": false},
                { data: 'cheque_number', name: 'cheque_number'},
                { data: 'action', name: 'action'}
            ],
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file"></i> Export to CSV',
                    className: 'btn btn-default btn-sm',
                    title: 'Outstanding Received Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                    className: 'btn btn-default btn-sm',
                    title: 'Outstanding Received Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i> Column Visibility',
                    className: 'btn btn-default btn-sm',
                    title: 'Outstanding Received Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i> Export to PDF',
                    className: 'btn btn-default btn-sm',
                    title: 'Outstanding Received Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    className: 'btn btn-default btn-sm',
                    title: 'Outstanding Received Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                    customize: function (win) {
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.body).find('h1').css('font-size', '25px');
                    },
                },
            ],
            "fnDrawCallback": function (oSettings) {

                $('#footer_sale_total').text(sum_table_col($('#outstanding_report_table'), 'final-total'));
                
                $('#footer_total_paid').text(sum_table_col($('#outstanding_report_table'), 'total-paid'));

                $('#footer_total_remaining').text(sum_table_col($('#outstanding_report_table'), 'payment_due'));

                $('#footer_total_sell_return_due').text(sum_table_col($('#outstanding_report_table'), 'sell_return_due'));

                $('#footer_payment_status_count').html(__sum_status_html($('#outstanding_report_table'), 'payment-status-label'));
                __currency_convert_recursively($('#outstanding_report_table'));
            },
     
        });
    });

    $(document).on('change', '#outstanding_report_date_filter, #outstanding_customer_id',  function() {
        outstanding_report_table.ajax.reload();
    });

</script>


<script>
   
$(document).ready(function(){
    aging_report_table = $('#aging_report_table').DataTable({
        processing: true,
        serverSide: true,
        "ajax": {
            "url": "{{action('ReportController@getAgingReport')}}",
            "data": function ( d ) {
                
                d.customer_id = $('#aging_customer_id').val();
                d.no_of_days_over = $('#no_of_days_over').val();
            }
        },
        buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file"></i> Export to CSV',
                    className: 'btn btn-default btn-sm',
                    title: 'Aging Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                    className: 'btn btn-default btn-sm',
                    title: 'Aging Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i> Column Visibility',
                    className: 'btn btn-default btn-sm',
                    title: 'Aging Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'pdf',
                    footer: true,
                    text: '<i class="fa fa-file-pdf-o"></i> Export to PDF',
                    className: 'btn btn-default btn-sm',
                    title: '',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                    customize: function (doc) {
                        var start = '';
                        var end = '';
                        var formattedstart = "";
                        var formattedend = "";
        
                        
        
                        doc.content.splice(0, 0, {
                            text: "{{$business_name}}",
                            fontSize: 18,
                            bold: true,
                            alignment: "center",
                            margin: [0, 0, 0, 5]
                        });
        
                        doc.content.splice(1, 0, {
                            text: "Aging Report",
                            fontSize: 16,
                            bold: true,
                            alignment: "center",
                            margin: [0, 0, 0, 5]
                        });
        
                        doc.content.splice(2, 0, {
                            text: "Date range from: " + formattedstart + " to: " + formattedend,
                            fontSize: 12,
                            bold: false,
                            alignment: "center",
                            margin: [0, 0, 0, 5]
                        });
        
                        doc.content.splice(3, 0, {
                            text: "Route:",
                            fontSize: 12,
                            bold: true,
                            margin: [0, 10, 0, 0]
                        });
        
                        doc.content.splice(4, 0, {
                            text: "Printed: " + "{{date('d M Y H:i')}}",
                            fontSize: 12,
                            bold: true,
                            margin: [0, 0, 0, 10]
                        });
                        
                        
                    }
                },
                {
                    extend: 'print',
                    footer: true,
                    text: '<i class="fa fa-print"></i> Print',
                    className: 'btn btn-default btn-sm',
                    title: '',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                    customize: function (win) {
                        
                        
                        var start = '';
                        var end = '';
                        var formattedstart = "";
                        var formattedend = "";
                        
                       
                                
                        
                        $(win.document.body).prepend('<div style="text-align:center"><h1><strong>'+ "{{$business_name}}" +'</strong></h1><h2>Aging Report</h2><h5>Date range from: '+ formattedstart +' to: ' + formattedend + '</h5><br><div class="align-left"><span><strong>Route:</strong></span><br><span><strong>Printed:</strong> ' + "{{date('d M Y H:i')}}" + '</span><br></div></div>');
                        
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.body).find('h2').css('text-align', 'center');
                        $(win.document.body).find('h5').css('text-align', 'center');
                        
                        $(win.document.body).find('h1').css('font-size', '18px');
                        $(win.document.body).find('h2').css('font-size', '16px');
                        $(win.document.body).find('h5').css('font-size', '12px');
                        
                    },
                    
                },
            ],
        columns: [
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'name', name: 'contacts.name'},
            { data: 'days_over', name: 'days_over',searchable : false},
            { data: "route", name: 'route'},
            { data: 'inv_no', name: 'transactions.invoice_no'},
            { data: '1_30_days', name: '1_30_days', className: 'text-right'},
            { data: '31_45_days', name: '31_45_days', className: 'text-right'},
            { data: '46_60_days', name: '46_60_days', className: 'text-right'},
            { data: '61_90_days', name: '61_90_days', className: 'text-right'},
            { data: 'over_90_days', name: 'over_90_days', className: 'text-right'},
            { data: 'final_total', name: 'final_total', className: 'text-right'},
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        "fnDrawCallback": function (oSettings) {
            $('#footer_total_amount_aging').text(sum_table_col($('#aging_report_table'), 'final-total-aging'));
       
            
            $('#footer_total_1_30').text(sum_table_col($('#aging_report_table'), '1_30_days-aging'));
            
            $('#footer_total_31_45').text(sum_table_col($('#aging_report_table'), '31_45_days-aging'));
            
            $('#footer_total_46_60').text(sum_table_col($('#aging_report_table'), '46_60_days-aging'));
            
            $('#footer_total_61_90').text(sum_table_col($('#aging_report_table'), '61_90_days-aging'));
            
            $('#footer_total_90').text(sum_table_col($('#aging_report_table'), 'over_90_days-aging'));
            
            __currency_convert_recursively($('#aging_report_table'));
            
        },
        rowCallback: function( row, data, index ) {
        var no_of_days_over = $('#no_of_days_over').val();
        
        if(no_of_days_over != ''){
            if (parseInt(data['days_over']) <= parseInt(no_of_days_over)) {
                $(row).hide();
            }

        }
        },
       
        
    });
})

    $(document).on('change', '#aging_report_date_filter, #aging_customer_id, #no_of_days_over',  function() {
        aging_report_table.ajax.reload();
    });
</script>

<script>
    
$(document).ready(function(){
    total_aging_report_table = $('#total_aging_report_table').DataTable({
        processing: true,
        serverSide: true,
        "ajax": {
            "url": "{{action('ReportController@getAgingReportTotal')}}",
            "data": function ( d ) {
                
                d.customer_id = $('#total_aging_customer_id').val();
                d.no_of_days_over = $('#total_no_of_days_over').val();
            }
        },
        buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file"></i> Export to CSV',
                    className: 'btn btn-default btn-sm',
                    title: 'Aging Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                    className: 'btn btn-default btn-sm',
                    title: 'Aging Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i> Column Visibility',
                    className: 'btn btn-default btn-sm',
                    title: 'Aging Report',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                },
                {
                    extend: 'pdf',
                    footer: true,
                    text: '<i class="fa fa-file-pdf-o"></i> Export to PDF',
                    className: 'btn btn-default btn-sm',
                    title: '',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                    customize: function (doc) {
                        var start = '';
                        var end = '';
                        var formattedstart = "";
                        var formattedend = "";
        
                        
        
                        doc.content.splice(0, 0, {
                            text: "{{$business_name}}",
                            fontSize: 18,
                            bold: true,
                            alignment: "center",
                            margin: [0, 0, 0, 5]
                        });
        
                        doc.content.splice(1, 0, {
                            text: "Aging Report",
                            fontSize: 16,
                            bold: true,
                            alignment: "center",
                            margin: [0, 0, 0, 5]
                        });
        
                        doc.content.splice(2, 0, {
                            text: "Date range from: " + formattedstart + " to: " + formattedend,
                            fontSize: 12,
                            bold: false,
                            alignment: "center",
                            margin: [0, 0, 0, 5]
                        });
        
                        doc.content.splice(3, 0, {
                            text: "Route:",
                            fontSize: 12,
                            bold: true,
                            margin: [0, 10, 0, 0]
                        });
        
                        doc.content.splice(4, 0, {
                            text: "Printed: " + "{{date('d M Y H:i')}}",
                            fontSize: 12,
                            bold: true,
                            margin: [0, 0, 0, 10]
                        });
                        
                        
                    }
                },
                {
                    extend: 'print',
                    footer: true,
                    text: '<i class="fa fa-print"></i> Print',
                    className: 'btn btn-default btn-sm',
                    title: '',
                    exportOptions: {
                        columns: function ( idx, data, node ) {
                            return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                                true : false;
                        } 
                    },
                    customize: function (win) {
                        
                        
                        var start = '';
                        var end = '';
                        var formattedstart = "";
                        var formattedend = "";
                        
                               
                        
                        $(win.document.body).prepend('<div style="text-align:center"><h1><strong>'+ "{{$business_name}}" +'</strong></h1><h2>Aging Report</h2><h5>Date range from: '+ formattedstart +' to: ' + formattedend + '</h5><br><div class="align-left"><span><strong>Route:</strong></span><br><span><strong>Printed:</strong> ' + "{{date('d M Y H:i')}}" + '</span><br></div></div>');
                        
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.body).find('h2').css('text-align', 'center');
                        $(win.document.body).find('h5').css('text-align', 'center');
                        
                        $(win.document.body).find('h1').css('font-size', '18px');
                        $(win.document.body).find('h2').css('font-size', '16px');
                        $(win.document.body).find('h5').css('font-size', '12px');
                        
                    },
                    
                },
            ],
        columns: [
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'name', name: 'contacts.name'},
            { data: 'days_over', name: 'days_over',searchable : false},
            { data: "route", name: 'route'},
            { data: 'inv_no', name: 'transactions.invoice_no'},
            { data: '1_30_days', name: '1_30_days', className: 'text-right'},
            { data: '31_45_days', name: '31_45_days', className: 'text-right'},
            { data: '46_60_days', name: '46_60_days', className: 'text-right'},
            { data: '61_90_days', name: '61_90_days', className: 'text-right'},
            { data: 'over_90_days', name: 'over_90_days', className: 'text-right'},
            { data: 'final_total', name: 'final_total', className: 'text-right'},
            // { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        "fnDrawCallback": function (oSettings) {
            $('#total_footer_total_amount_aging').text(sum_table_col($('#total_aging_report_table'), 'final-total-aging'));
       
            
            $('#total_footer_total_1_30').text(sum_table_col($('#total_aging_report_table'), '1_30_days-aging'));
            
            $('#total_footer_total_31_45').text(sum_table_col($('#total_aging_report_table'), '31_45_days-aging'));
            
            $('#total_footer_total_46_60').text(sum_table_col($('#total_aging_report_table'), '46_60_days-aging'));
            
            $('#total_footer_total_61_90').text(sum_table_col($('#total_aging_report_table'), '61_90_days-aging'));
            
            $('#total_footer_total_90').text(sum_table_col($('#total_aging_report_table'), 'over_90_days-aging'));
            
            __currency_convert_recursively($('#total_aging_report_table'));
            
        },
        rowCallback: function( row, data, index ) {
        var no_of_days_over = $('#total_no_of_days_over').val();
        
        if(no_of_days_over != ''){
            if (parseInt(data['days_over']) <= parseInt(no_of_days_over)) {
                $(row).hide();
            }

        }
        },
       
        
    });
})

    $(document).on('change', '#total_aging_report_date_filter, #total_aging_customer_id, #total_no_of_days_over',  function() {
        total_aging_report_table.ajax.reload();
    });
</script>

@endsection