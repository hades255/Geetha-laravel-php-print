<style>
    #financail_status_table {
        table-layout: fixed;
        width: 100%;
    }

    #financail_status_table td {
        width: 25%;
    }

    table>tbody>tr>td {
        font-size: 14px !important;
    }

    table>thead>tr>th {
        font-size: 14px !important;
    }

    .heading_td {
        width: 75%;
    }
    .sales-section, .header-border-right{
        border-right: 1px solid red !important;
    }
    .header-border{
        text-align:center;
        border: 1px solid red !important;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
            @slot('tool')
            <div class="box-tools" style="display: flex;">
            <button class="btn btn-primary print_report pull-right" style="background-color: seagreen;" onclick="generateExcel('monthly')">
                    <i class="fa fa-print"></i> Excel</button>
                <button class="btn btn-primary print_report pull-right" style="margin-left: 5px;" onclick="printMonthlyReport()">
                    <i class="fa fa-print"></i> @lang('messages.print')</button>
            </div>
            @endslot
            <div id="monthly_report_div">
                <style>
                    @media print {
                        td {
                            line-height: 5px !important;
                        }

                        th {
                            line-height: 5px !important;
                        }
                    }
                </style>

                @php
                $count = count($income_accounts);
                @endphp


                <div class="table-responsive">
                    <h4 class="pull-left text-red">@lang('report.month_range'):
                        @if($print_s_date!=$print_e_date)@lang('report.from') {{$print_s_date}}
                        @lang('report.to') {{$print_e_date}} @else {{$print_s_date}} @endif ({{$year}}) </h4>
                    <table class="table table-bordered table-striped" id="daily_report_table">
                        <thead>
                        </thead>
                        <tbody>
                            @if(!empty($location_details))
                            <tr>
                                <th colspan="{{ $count+ 23 }}" class="text-center">{{$location_details->name}} <br>
                                    {{$location_details->city}}
                                </th>
                            </tr>
                            @else
                            <tr>
                                <th colspan="{{ $count+ 23 }}" class="text-center">
                                    {{request()->session()->get('business.name')}}
                                </th>
                            </tr>
                            @endif
                            <tr>
                                <th colspan="{{ $count+ 23 }}" class="text-right">Shift: {{$work_shift}}</th>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped" id="sale_table">
                        <thead>
                            <tr>
                                <th colspan="" class="text-left"><span
                                        style="background: #800080; padding: 5px 10px 5px 10px; color: #fff;">@lang('report.sale')</span>
                                </th>
                                <th colspan="3" class="header-border-right"></th>
                                <th colspan="{{$count}}" class="header-border">
                                    <span>@lang('report.sales_section')</span>
                                </th>
                                <th colspan="" class="header-border-right"></th>
                                <th colspan="{{$count-1}}" class="header-border">
                                    <!--<span>@lang('report.sales_section')</span>-->
                                    <span>Sales in Qty</span>
                                </th>
                                <th colspan="" class="header-border-right"></th>
                                <th colspan="6" class="header-border"><span>@lang('report.payment_section')</span></th>
                                <th colspan="" class="header-border-right"></th>
                                <th colspan="4" class="header-border"><span>@lang('report.other_section')</span></th>
                                <th colspan="" class="header-border-right"></th>
                                <th colspan="3" class="header-border"><span>@lang('report.customer_payment_section')</span></th>
                                <th colspan="" class="header-border-right"></th>
                                <th colspan="5" class="header-border"><span>@lang('report.summary')</span></th>
                            </tr>
                            <tr>
                                <th>@lang('report.date')</th>
                                <th colspan="2">@lang('report.sale')</th>
                                <th class="header-border-right"></th>
                                @foreach($income_accounts as $key => $income_account)
                                    <th class="{{ (count($income_accounts) - 1 === $key) ? 'sales-section' : '' }}">{{ (strpos($income_account->name,'-') !== false ? explode('-',$income_account->name)[1]:$income_account->name)}}</th>
                                @endforeach
                                <th class="header-border-right"></th>
                                @foreach($income_accounts as $key => $income_account)
                                    @if($key!=0)
                                    <th class="{{ (count($income_accounts) - 1 === $key) ? 'sales-section' : '' }}">{{ (strpos($income_account->name,'-') !== false ? explode('-',$income_account->name)[1]:$income_account->name)}}</th>
                                    @endif
                                @endforeach
                                <th style="border-right:1px solid red;"></th>
                                <th>@lang('report.cash_total')</th>
                                <th>@lang('report.cheque_total')</th>
                                <!-- <th>@lang('report.visa_master_total') </th>
                                <th>@lang('report.amex_total')</th> -->
                                <th>@lang('report.credit_cards')</th>
                                <th>@lang('report.short_total')</th>
                                <th>@lang('report.excess_total') </th>
                                <th class="header-border-right">@lang('report.credit_sales')</th>
                                <th class="header-border-right"></th>
                                <!-- <th>@lang('report.expense_in_settlement_total')</th> -->
                                <th>@lang('report.direct_expense_total') </th>
                                <th>@lang('report.supplier_payment_in_cash_total')</th>
                                <th>@lang('report.total_collection')</th>
                                <th class="header-border-right">@lang('report.difference')</th>
                                <th class="header-border-right"></th>
                                <th>@lang('report.credit_cash')</th>
                                <th>@lang('report.credit_cheques')</th>
                                <th class="header-border-right">@lang('report.all_cards')</th>
                                <!--
                                <th class="header-border-right">@lang('report.credit_amex_master')</th> -->
                                <th class="header-border-right"></th>
                                <th>@lang('report.today_total_cash')</th>
                                <th>@lang('report.previous_day_cash_balance')</th>
                                <th>@lang('report.total_cash_balance')</th>
                                <th>@lang('report.direct_cash_expenses')</th>
                                <th>@lang('report.cash_deposited') </th>
                                <th class="header-border-right">@lang('report.cash_in_hand')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_sales_amount = 0;
                        @endphp
                            @foreach ($period as $date)
                            @php
                            $date = $date->format('Y-m-d');
                            @endphp


                            <tr>
                                <td> {{ @format_date($date) }}</td>
                                <td colspan="2">{{@num_format($total_sales[$date])}}</td>
                                <td class="header-border-right"></td>
                                @foreach($income_accounts as $key => $income_account)
                                <td class="{{ (count($income_accounts) - 1 === $key) ? 'sales-section' : '' }}"> {{ @num_format( $sales_income_amount[$date][$income_account->id]['amount']) }}</td>
                                @endforeach
                                <td class="header-border-right"></td>
                                @foreach($income_accounts as $key => $income_account)
                                    @if($key!=0)
                                       <td class="{{ (count($income_accounts) - 1 === $key) ? 'sales-section' : '' }}">  {{ @num_format( $sales_income_amount[$date][$income_account->id]['qty']) }}</td>
                                    @endif
                                @endforeach
                                <td class="header-border-right"></td>
                                <td>
                                    {{  @num_format($received_payments[$date]->cash) }}
                                </td>
                                <td>
                                    {{  @num_format($received_payments[$date]->cheque) }}
                                </td>
                                <!-- <td>
                                    {{  @num_format($received_payments[$date]->visa) }}
                                </td>
                                <td>
                                    {{  @num_format($received_payments[$date]->amex) }}
                                </td> 
                                <td>
                                    {{  @num_format($received_payments[$date]->other_card) }}
                                </td>
                                 -->
                                 <td>
                                    {{  @num_format($received_payments[$date]->credit_card) }}
                                </td>
                               
                                <td>
                                    {{  @num_format($shortage_total[$date]) }}
                                </td>
                                <td>
                                    {{  @num_format($excess_total[$date]) }}
                                </td>
                                <td class="header-border-right">
                                    {{  @num_format($credit_sales[$date]) }}
                                </td>
                                <td class="header-border-right"></td>
                                <!-- <td>
                                    {{  @num_format($expense_in_settlement[$date]) }}
                                </td> -->
                                <td>
                                    {{  @num_format($direct_expens[$date]) }}
                                </td>
                                <td>
                                    {{  @num_format($purchase_by_cash[$date]) }}
                                </td>
                                <td>
                                    {{  @num_format($total_collection[$date]) }}
                                </td>
                                <td class="header-border-right">
                                    {{  @num_format($difference[$date]) }}
                                </td>
                                <td class="header-border-right"></td>
                                <td>
                                    {{  @num_format($credit_received_payments[$date]->cash) }}
                                </td>
                                <td>
                                    {{  @num_format($credit_received_payments[$date]->cheque) }}
                                </td>
                                <td class="header-border-right">
                                    {{  @num_format($credit_received_payments[$date]->credit_card) }}
                                </td>                              
                                <td class="header-border-right"></td>
                                <td>
                                    {{  @num_format($today_total_cash[$date]) }}
                                </td>
                                <td>
                                    {{  @num_format($previous_day_cash_balance[$date]) }}
                                </td>
                                <td>
                                    {{  @num_format($total_cash_balance[$date]) }}
                                </td>
                                
                                <td>
                                    {{  @num_format($direct_expens[$date]) }}
                                </td>
                                
                                <td>
                                    {{  @num_format($cash_deposit[$date]) }}
                                </td>
                                <td class="header-border-right">
                                    {{  @num_format($cash_balance_difference[$date]-$direct_expens[$date]) }}
                                </td>
                            </tr>
                            @php
                            $total_sales_amount += $total_sales[$date];
                            @endphp
                            @endforeach
                            <tr>
                                <th colspan="4">Total Sale Amount</th>
                                <th>{{@num_format($total_sales_amount)}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>