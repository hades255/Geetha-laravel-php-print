

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div id="report_div">
                <div id="print_header_div">
                    <style>
                        @media print {
                            #report_print_div {-webkit-print-color-adjust: exact;}
                        }
                        .bg_color {
                            background: #8F3A84 !important;
                            font-size: 20px;
                            color: #fff !important;
                            print-color-adjust: exact;
                        }

                        .text-center {
                            text-align: center;
                        }

                        #customer_detail_table th {
                            background: #8F3A84 !important;
                            color: #fff !important;
                            print-color-adjust: exact;
                        }
                        
                        #customer_statement_table th {
                            background: #8F3A84 !important;
                            color: #fff !important;
                            print-color-adjust: exact;
                        }

                        #customer_detail_table>tbody>tr:nth-child(2n+1)>td,
                        #customer_detail_table>tbody>tr:nth-child(2n+1)>th {
                            background-color: #F3BDEB !important;
                            print-color-adjust: exact;
                        }
                        .uppercase {
                          text-transform: uppercase;
                        }
                    </style>
                    @php
                    $currency_precision = !empty($business_details->currency_precision) ?
                    $business_details->currency_precision : 2;
                    @endphp
                    <div class="col-md-12 col-sm-12 @if(!empty($for_pdf)) width-100 text-center @endif">
                        <p class="text-center uppercase">
                            <strong>CUSTOMER STATEMENT<br>{{$contact->business->name}}</strong><br>{{$location_details->city}},
                            {{$location_details->state}}<br>{!!
                            $location_details->mobile !!}</p>
                        <hr>
                        <p class="text-center" style="color: #8F3A84 !important;print-color-adjust: exact;">
                            <strong>Date Range from {{date('d M Y',strtotime($start_date))}} to {{date('d M Y',strtotime($end_date))}}</strong></p>
                    </div>
                    <div class="col-md-12 text-center">
                        <h4 class="modal-title" id="modalTitle"><b>@lang('lang_v1.invoice_no'):</b>
                            {{ $statement->statement_no }}
                        </h4>
                    </div>
                    <table style="width: 100%">
                        <tr>
                            
                            <td>
                                <div class="col-md-6 col-sm-6 col-xs-6 @if(!empty($for_pdf)) width-50 f-left @endif" style="float: left">
                                    <p class="bg_color" style="width: 40%; margin-top: 20px;">Customer:</p>
                                    <p><strong>{{$contact->name}}</strong><br> {!! $contact->contact_address !!}
                                        @if(!empty($contact->email))
                                        <br>@lang('business.email'): {{$contact->email}} @endif
                                        <br>@lang('contact.mobile'): {{$contact->mobile}}
                                        @if(!empty($contact->tax_number)) <br>@lang('contact.tax_no'): {{$contact->tax_number}}
                                        @endif
                                        <br>
                                        <strong>Printed on: </strong>{{date('d M Y H:m')}}
                                    </p>
                                </div>
                            </td>
                            
                            <td>
                                <div
                                class="col-md-6 col-sm-6 col-xs-6 text-right align-right @if(!empty($for_pdf)) width-50 f-left @endif" style="float: right;">
                                <p class=" bg_color"
                                    style="margin-top: @if(!empty($for_pdf)) 20px @else 0px @endif; font-weight: 500;">
                                    @lang('lang_v1.account_summary')</p>
                                
                                <table
                                    class="table table-condensed text-left align-left no-border @if(!empty($for_pdf)) table-pdf @endif"
                                    id="customer_detail_table">
                                    <tr>
                                        <td>@lang('lang_v1.beginning_balance')</td>
                                        <td>{{@num_format($ledger_details['beginning_balance'])}}
                                        </td>
                                    </tr>
                                    @if( $contact->type == 'supplier' || $contact->type == 'both')
                                    <tr>
                                        <td>@lang('report.total_purchase')</td>
                                        <td>{{@num_format($ledger_details['total_purchase'])}}
                                        </td>
                                    </tr>
                                    @endif
                                    @if( $contact->type == 'customer' || $contact->type == 'both')
                                    <tr>
                                        <td>@lang('lang_v1.total_sales')</td>
                                        <td>{{@num_format($ledger_details['total_invoice'])}}
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>@lang('sale.total_paid')</td>
                                        <td>{{@num_format($ledger_details['total_paid'])}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>@lang('lang_v1.balance_due')</strong></td>
                                        <td>{{@num_format($ledger_details['balance_due'])}}</td>
                                    </tr>
                                </table>
                            </div>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="row" style="margin-top: 0x;">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped" id="customer_statement_table">
                            <thead>
                                <tr>
                                    <th>@lang('contact.date')</th>
                                    <th>@lang('contact.location')</th>
                                    <th>@lang('contact.invoice_no')</th>
                                    <th>Route</th>
                                    <th>Vehicle</th>
                                    <th>@lang('contact.customer_reference')</th>
                                    <th>@lang('lang_v1.customer_po_no')</th>
                                    <th>@lang('contact.voucher_order_date')</th>
                                    <th>@lang('contact.product')</th>
                                    <th>@lang('contact.qty')</th>
                                    <th>@lang('contact.unit_price')</th>
                                    <th>@lang('contact.invoice_amount')</th>
                                    <th>@lang('contact.due_amount')</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($statement_details as $item)
                                <tr>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->location}}</td>
                                    <td>{{$item->invoice_no}}</td>
                                    <td>{{$item->route_name}}</td>
                                    <td>{{$item->vehicle_number}}</td>
                                    <td>{{$item->customer_reference}}</td>
                                    <td>{{$item->order_no}}</td>
                                    <td>{{$item->order_date}}</td>
                                    <td>{{$item->product}}</td>
                                    <td>{{@format_quantity($item->qty)}}</td>
                                    <td>{{@num_format($item->unit_price)}}</td>
                                    <td>{{@num_format($item->invoice_amount)}}</td>
                                    <td>{{@num_format($item->due_amount)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <table width="100%" style="position: fixed; bottom: 0; left:0 ">
                    <tr>
                        <th class="width-50">
                            <strong>Signature :...............................................                                                          </strong>
                        </th>
                        <th  class="width-50">
                            Total: {{@num_format($ledger_details['total_invoice'])}}</strong>
                        </th>
                    </tr>
                </table>
                
               
                
            </div>
        </div>
    </div>

</section>