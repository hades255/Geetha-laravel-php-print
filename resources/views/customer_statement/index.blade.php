@extends('layouts.app')
@section('title', __('contact.customer_statements'))
<!-- this style will hide the page title and print date -->
<style>
    @page{size:auto; margin:5mm ;}
    table#customer_statement_table > tbody > tr > td {
        padding: 2px !important;
    }
@media print{
    html,body,buttons,input,textarea,etc {
        font-family: Calibri !important;
        background: #357ca5 !important;
    }
    .dt-buttons,
    .dataTables_length,
    .dataTables_filter,
    .dataTables_info,
    .dataTables_paginate {
        display: none;
    }

    #print_header_div {
        display: inline !important;
    }

    .customer_details_div {
        display: none;
    }
    .margin-bottom-20 {
        margin-bottom: 0px !important;
    }
    table.dataTable {
        margin-top: 0px !important;
    }
}

 .buttons-pdf{
        display: none !important;
    }
    
    .buttons-print{
        display: none !important;
    }

</style>
@section('content')
<section class="content-header main-content-inner">
    <div class="row">
        <div class="col-md-12 dip_tab">
            <div class="settlement_tabs">
                <ul class="nav nav-tabs">
                    <li class="active" style="margin-left: 20px;">
                        <a style="font-size:13px;" href="#customer_statements" class="" data-toggle="tab">
                            <i class="fa fa-superpowers"></i> <strong>@lang('contact.customer_statements')</strong>
                        </a>
                    </li>
                    <li class="" style="margin-left: 20px;">
                        <a style="font-size:13px;" href="#list_customer_statements" class="" data-toggle="tab">
                            <i class="fa fa-list"></i>
                            <strong>@lang('contact.list_customer_statements')</strong>
                        </a>
                    </li>
                    @if($enable_separate_customer_statement_no)
                    @can('enable_separate_customer_statement_no')
                    <li class="" style="margin-left: 20px;">
                        <a style="font-size:13px;" href="#settings_customer_statements" class="" data-toggle="tab">
                            <i class="fa fa-cogs"></i>
                            <strong>@lang('contact.settings_customer_statements')</strong>
                        </a>
                    </li>
                    @endcan
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="customer_statements">
            @include('customer_statement.partials.customer_statements')
        </div>
        <div class="tab-pane" id="list_customer_statements">
            @include('customer_statement.partials.list_customer_statements')
        </div>
        @if($enable_separate_customer_statement_no)
        @can('enable_separate_customer_statement_no')
        <div class="tab-pane" id="settings_customer_statements">
            @include('customer_statement.partials.settings_customer_statements')
        </div>
        @endcan
        @endif
    </div>

    <div class="modal fade customer_statement_modal" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>


<div class="hide">
    <div id="report_print_div"></div>
</div>
</section>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready( function(){
        var body = document.getElementsByTagName("body")[0];
        body.className += " sidebar-collapse";

        var columns = [
            { data: 'customer_name', name: 'customer_name' },
            { data: 'starting_no', name: 'starting_no' },
            { data: 'action', searchable: false, orderable: false },
        ];

        statement_settings_table = $('#statement_settings_table').DataTable({
        processing: true,
        serverSide: false,
        aaSorting: [[0, 'desc']],
        ajax: '/customer-statement-settings',
        columns: columns,
        fnDrawCallback: function(oSettings) {

            },
        });


        customer_statement_table = $('#customer_statement_table').DataTable({
        processing: true,
        serverSide: false,
        aaSorting: [[0, 'desc']],
        pageLength: -1,
        ajax: {
            url: '/customer-statement',
            data: function(d) {
                d.location_id = $('select#customer_statement_location_id').val();
                d.customer_id = $('select#customer_statement_customer_id').val();
                var start = '';
                var end = '';
                if ($('input#customer_statement_date_range').val()) {
                    start = $('input#customer_statement_date_range')
                        .data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                    end = $('input#customer_statement_date_range')
                        .data('daterangepicker')
                        .endDate.format('YYYY-MM-DD');
                }
                d.start_date = start;
                d.end_date = end;
            },
        },
        @include('layouts.partials.datatable_export_button')
        columnDefs: [
            { "width": "5%", "targets": 0 },
            { "width": "10%", "targets": 1 },
            { "width": "5%", "targets": 2 },
            { "width": "5%", "targets": 3 },
            { "width": "5%", "targets": 4 },
            { "width": "5%", "targets": 5 },
            { "width": "5%", "targets": 6 },
            { "width": "5%", "targets": 7 },
            { "width": "4%", "targets": 8 },
            { "width": "20%", "targets": 9 },
            { "width": "8%", "targets": 10 ,className: 'text-right'},
            { "width": "8%", "targets": 11 ,className: 'text-right'},
            { "width": "8%", "targets":  12 ,className: 'text-right'},
            // { "width": "8%", "targets":  11 ,className: 'text-right'},
             {
                "targets": 13,
                "visible": false,
            },
        ],
        columns:  [
            { data: 'action', searchable: false, orderable: false },
            { data: 'transaction_date', name: 'transaction_date' },
            { data: 'order_no', name: 'order_no' },
            // { data: 'location', name: 'location' },
            { data: 'invoice_no', name: 'invoice_no' },
            
            { data: 'route_name', name: 'invoice_no' },
            { data: 'vehicle_number', name: 'invoice_no' },
            
            { data: 'ref_no', name: 'ref_no' },
            { data: 'order_date', name: 'order_date' },
            { data: 'product', name: 'product' },
            { data: 'quantity', name: 'quantity' },
            { data: 'unit_price', name: 'unit_price' },
            { data: 'final_total', name: 'final_total' },
            { data: 'due_amount', name: 'due_amount' },
            {data: 'final_due_amount', searchable: false, orderable: false, name: 'due_amount'},
        ],
        fnDrawCallback: function(oSettings) {
            due_total = sum_table_col($('#customer_statement_table'), 'due');
            $('#due_total').val(due_total);
            },
        });
        
        
        $('#customer_statement_date_range, #customer_statement_location_id, #customer_statement_customer_id').on('change input', function(){
                loadStatements();
        });

        $('#customer_statement_customer_id').select2();

        $(document).on('click', '.reprint_statement', function(e){
            e.preventDefault();
            href = $(this).data('href');
            $.ajax({
                method: 'get',
                contentType: 'html',
                url: href,
                data: {  },
                success: function(result) {
                    $('#report_print_div').empty().append(result);
                    $('#report_print_div').printThis();

                },
            });
        });
        
        $(document).on('click', '.pdf_statement', function(e){
            e.preventDefault();
            href = $(this).data('href');
            $.ajax({
                method: 'get',
                contentType: 'html',
                url: href,
                data: {  },
                success: function(result) {
                    $('#report_print_div').empty().append(result);
                    generatePdf(result,'pdf');

                },
            });
        });
        
        $(document).on('click', '.email_statement', function(e){
            e.preventDefault();
            href = $(this).data('href');
            $.ajax({
                method: 'get',
                contentType: 'html',
                url: href,
                data: {  },
                success: function(result) {
                    $('#report_print_div').empty().append(result);
                    generatePdf(result,'email');

                },
            });
        });

});

$('#customer_id').select2();

$('#enable_separate_customer_statement_no').change(function(){
    console.log($(this).val());
    if($(this).val() == 1){
        console.log("value 1");
        $('.customer_separate_field').removeClass('hide');
        $('.customer_separate_field_no').addClass('hide');
    }else if ($(this).val() == 0){
        console.log("value 0");
        $('.customer_separate_field').addClass('hide');
        $('.customer_separate_field_no').removeClass('hide');
    }
});

$('#settings_statement_btn').click(function(){
    $.ajax({
        method: 'post',
        url: '/customer-statement-settings',
        data: {
            enable_separate_customer_statement_no : $('#enable_separate_customer_statement_no').val(),
            customer_id : $('#customer_id').val(),
            starting_no : $('#starting_no').val(),
         },
        success: function(result) {
            if(result.success == 1){
                toastr.success(result.msg);
            }else{
                toastr.error(result.msg);
            }
            statement_settings_table.ajax.reload();
        },
    });
})
$(document).on('click', '#edit_statement_settings', function(){
    url = $('#customer_statement_setting_add_form').attr('action');

    $.ajax({
        method: 'put',
        url: url,
        data: {
            enable_separate_customer_statement_no : $('#edit_enable_separate_customer_statement_no').val(),
            customer_id : $('#edit_customer_id').val(),
            starting_no : $('#edit_starting_no').val(),
         },
        success: function(result) {
            if(result.success == 1){
                toastr.success(result.msg);
            }else{
                toastr.error(result.msg);
            }

            $('.customer_statement_modal').modal('hide');

            statement_settings_table.ajax.reload();
        },
    });
})

    if ($('#customer_statement_date_range').length == 1) {
        $('#customer_statement_date_range').daterangepicker(dateRangeSettings, function(start, end) {
            $('#customer_statement_date_range').val(
                start.format(moment_date_format) + ' - ' + end.format(moment_date_format)
            );
            customer_statement_table.ajax.reload();
            loadStatements();
        });
        $('#customer_statement_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#product_sr_date_filter').val('');
        });
        $('#customer_statement_date_range')
            .data('daterangepicker')
            .setStartDate(moment().startOf('month'));
        $('#customer_statement_date_range')
            .data('daterangepicker')
            .setEndDate(moment().endOf('month'));
    }
    
    
    
    function loadStatements()
        {
            if($('#customer_statement_customer_id').val() !== '' && $('#customer_statement_customer_id').val() !== undefined){
                
                // get customer minimum date
                var mindate = null;
                
                $.ajax({
                    method: 'get',
                    url: '/customer-date',
                    data: { id : $('#customer_statement_customer_id').val() },
                    success: function(result) {
                        
                        var location_id = $('select#customer_statement_location_id').val();
                            var customer_id = $('select#customer_statement_customer_id').val();
                            var start = '';
                            var end = '';
                            if ($('input#customer_statement_date_range').val()) {
                                start = $('input#customer_statement_date_range')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                end = $('input#customer_statement_date_range')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                
                                $('.from_date').text($('input#customer_statement_date_range')
                                    .data('daterangepicker')
                                    .startDate.format('DD-MM-YYYY'));
                                $('.to_date').text($('input#customer_statement_date_range')
                                    .data('daterangepicker')
                                    .endDate.format('DD-MM-YYYY'));
                            }
                        
                        
                        if(result.date){
                            mindate = result.date;
                            
                            // Convert the startDate to a Unix timestamp
                            var startDateTimestamp = new Date(start).getTime() / 1000;
                            if(mindate){
                                // Convert the "2023-03-01" date to a Unix timestamp
                                var targetDateTimestamp = new Date(mindate).getTime() / 1000;
                            }else{
                                var targetDateTimestamp = 0;
                            }
                            
                            
                            // Compare the timestamps
                            if (startDateTimestamp <= targetDateTimestamp) {
                                toastr.error("You cannot regenerate statements older than " + mindate + " for "+$('#customer_statement_customer_id option:selected').text());
                            } else {
                                
                                customer_statement_table.ajax.reload();
                                
                                var start_date = start;
                                var end_date = end;
                                var statement_no = $('#statement_no').val();
                    
                                $.ajax({
                                    method: 'get',
                                    url: '/get-customer-statement-no',
                                    data: { customer_id : $('#customer_statement_customer_id').val(),  start_date : start_date, end_date : end_date },
                                    success: function(result) {
                                        console.log(result);
                                        // $('.statement_no').text(result.statement_no);
                                        $('#statement_no').val(result.statement_no);
                                        $('#print_header_div').empty().append(result.header);
                    
                                    },
                                });
                                
                            }
                
                            
            
                        }else{
                            customer_statement_table.ajax.reload();
                                
                                var start_date = start;
                                var end_date = end;
                                var statement_no = $('#statement_no').val();
                    
                                $.ajax({
                                    method: 'get',
                                    url: '/get-customer-statement-no',
                                    data: { customer_id : $('#customer_statement_customer_id').val(),  start_date : start_date, end_date : end_date },
                                    success: function(result) {
                                        console.log(result);
                                        // $('.statement_no').text(result.statement_no);
                                        $('#statement_no').val(result.statement_no);
                                        $('#print_header_div').empty().append(result.header);
                    
                                    },
                                });
                                
                    
                        }
    
                    },
                });
                
                
                // $('.customer_name').text($('#customer_statement_customer_id :selected').text());
            }else{
                var start = '';
                var end = '';
                if ($('input#customer_statement_date_range').val()) {
                    start = $('input#customer_statement_date_range')
                        .data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                    end = $('input#customer_statement_date_range')
                        .data('daterangepicker')
                        .endDate.format('YYYY-MM-DD');
    
                    $('.from_date').text($('input#customer_statement_date_range')
                        .data('daterangepicker')
                        .startDate.format('DD-MM-YYYY'));
                    $('.to_date').text($('input#customer_statement_date_range')
                        .data('daterangepicker')
                        .endDate.format('DD-MM-YYYY'));
                }
                customer_statement_table.ajax.reload();
                                
                var start_date = start;
                var end_date = end;
                var statement_no = $('#statement_no').val();
    
                $.ajax({
                    method: 'get',
                    url: '/get-customer-statement-no',
                    data: { customer_id : $('#customer_statement_customer_id').val(),  start_date : start_date, end_date : end_date },
                    success: function(result) {
                        console.log(result);
                        // $('.statement_no').text(result.statement_no);
                        $('#statement_no').val(result.statement_no);
                        $('#print_header_div').empty().append(result.header);
    
                    },
                });
            }
        }

    let date = $('#customer_statement_date_range').val().split(' - ');

    $('.from_date').text(date[0]);
    $('.to_date').text(date[1]);

    if ($('#list_customer_statement_date_range').length == 1) {
        $('#list_customer_statement_date_range').daterangepicker(dateRangeSettings, function(start, end) {
            $('#list_customer_statement_date_range').val(
                start.format(moment_date_format) + ' - ' + end.format(moment_date_format)
            );
            customer_statement_list_table.ajax.reload();
        });
        $('#list_customer_statement_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#product_sr_date_filter').val('');
        });
        $('#list_customer_statement_date_range')
            .data('daterangepicker')
            .setStartDate(moment().startOf('month'));
        $('#list_customer_statement_date_range')
            .data('daterangepicker')
            .setEndDate(moment().endOf('month'));
    }
    
    if ($('#printed_list_customer_statement_date_range').length == 1) {
        $('#printed_list_customer_statement_date_range').daterangepicker(dateRangeSettings, function(start, end) {
            $('#printed_list_customer_statement_date_range').val(
                start.format(moment_date_format) + ' - ' + end.format(moment_date_format)
            );
            customer_statement_list_table.ajax.reload();
        });
        $('#printed_list_customer_statement_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#product_sr_date_filter').val('');
        });
        $('#printed_list_customer_statement_date_range')
            .data('daterangepicker')
            .setStartDate(moment().startOf('month'));
        $('#printed_list_customer_statement_date_range')
            .data('daterangepicker')
            .setEndDate(moment().endOf('month'));
    }
    
    $(document).ready( function(){
        
        customer_statement_list_table = $('#customer_statement_list_table').DataTable({
            processing: true,
            serverSide: false,
            aaSorting: [[0, 'desc']],
            ajax: {
                url: '/customer-statement/get-statement-list',
                data: function(d) {
                    d.location_id = $('select#list_customer_statement_location_id').val();
                    d.customer_id = $('select#list_customer_statement_customer_id').val();
                    var start = '';
                    var end = '';
                    if ($('input#list_customer_statement_date_range').val()) {
                        start = $('input#list_customer_statement_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#list_customer_statement_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    var printed_start = '';
                    var printed_end = '';
                    
                    if ($('input#printed_list_customer_statement_date_range').val()) {
                        printed_start = $('input#printed_list_customer_statement_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        printed_end = $('input#printed_list_customer_statement_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    
                    d.start_date = start;
                    d.end_date = end;
                    d.printed_start = printed_start; 
                    d.printed_end = printed_end;
                    
                    // console.log(d);
                },
            },
            columns: [
                { data: 'action', searchable: false, orderable: false },
                { data: 'print_date', name: 'print_date' },
                { data: 'location', name: 'location' },
                { data: 'date_from', name: 'date_from' },
                { data: 'date_to', name: 'date_to' },
                { data: 'customer', name: 'customer' },
                { data: 'statement_no', name: 'statement_no' },
                { data: 'amount', name: 'amount' },
                { data: 'username', name: 'username' },
            ],
            });

            $('#list_customer_statement_date_range, #list_customer_statement_customer_id, #list_customer_statement_location_id').change(function(){
                customer_statement_list_table.ajax.reload();
            });
        });
</script>

<script>
    function generatePdf(html,action) {
        $.ajax({
            url: '/download-pdf',
            method: 'POST',
            data: {
                html: html
            },
            success: function(data) {
                // Handle the success response, for example:
                var downloadUrl = data.path;
                if(action == "email"){
                    emailPdf(downloadUrl);
                }else if(action == "pdf"){
                    downloadPdf(downloadUrl);
                }
                
            },
            error: function(xhr, status, error) {
                // Handle the error response, for example:
                alert('An error occurred while generating the PDF.');
            }
        });
    }
    function emailPdf(file){
        console.log(file)
        const emailAddress = '';
        const emailSubject = 'Statement';
        const emailBody = 'Please find attached copy of your Customer Statement';

        let mailtoUrl = `mailto:${emailAddress}?subject=${encodeURIComponent(emailSubject)}&body=${encodeURIComponent(emailBody)}`;

        // Append the attachment header to the mailto URL
        mailtoUrl += `&attachment=${encodeURIComponent(file)}&Content-Type=application/pdf`;
        
        console.log(mailtoUrl);
        
        // Open the user's default email client with the pre-populated email
        window.open(mailtoUrl, '_blank');
    }
    function downloadPdf(file){
        var link = document.createElement('a');
        link.href = file;
        link.download = 'report.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    function saveDiv() {
        var location_id = $('select#customer_statement_location_id').val();
        var customer_id = $('select#customer_statement_customer_id').val();
        var start = '';
        var end = '';
        if ($('input#customer_statement_date_range').val()) {
            start = $('input#customer_statement_date_range')
                .data('daterangepicker')
                .startDate.format('YYYY-MM-DD');
            end = $('input#customer_statement_date_range')
                .data('daterangepicker')
                .endDate.format('YYYY-MM-DD');
        }
        var start_date = start;
        var end_date = end;
        var statement_no = $('#statement_no').val();
        $.ajax({
            method: 'post',
            url: '/customer-statement',
            data: {
                location_id : location_id,
                customer_id : customer_id,
                start_date : start_date,
                end_date : end_date,
                statement_no : statement_no,
             },
            success: function(result) {
                if(result.success == 1){
                    toastr.success(result.msg);
                }else{
                    toastr.error(result.msg);
                }
            },
        });

    }
</script>

@endsection
