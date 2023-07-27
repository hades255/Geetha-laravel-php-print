<html>
@php
    $count = count($income_accounts);
@endphp

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
        <tr>
            <th colspan="{{ $count+ 23 }}" class="text-right">Month Range: @if($print_s_date!=$print_e_date)@lang('report.from') {{$print_s_date}}
                    @lang('report.to') {{$print_e_date}} @else {{$print_s_date}} @endif ({{$year}})
            </th>
        </tr>
    </tbody>
</table>
<table id="table_id" class="display">
    <thead>
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
        <th>@lang('report.credit_cards')</th>
        <th>@lang('report.short_total')</th>
        <th>@lang('report.excess_total') </th>
        <th class="header-border-right">@lang('report.credit_sales')</th>
        <th class="header-border-right"></th>
        <th>@lang('report.direct_expense_total') </th>
        <th>@lang('report.supplier_payment_in_cash_total')</th>
        <th>@lang('report.total_collection')</th>
        <th class="header-border-right">@lang('report.difference')</th>
        <th class="header-border-right"></th>
        <th>@lang('report.credit_cash')</th>
        <th>@lang('report.credit_cheques')</th>
        <th class="header-border-right">@lang('report.all_cards')</th>
        <th class="header-border-right"></th>
        <th>@lang('report.today_total_cash')</th>
        <th>@lang('report.previous_day_cash_balance')</th>
        <th>@lang('report.total_cash_balance')</th>
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
            {{  @num_format($cash_deposit[$date]) }}
        </td>
        <td class="header-border-right">
            {{  @num_format($cash_balance_difference[$date]) }}
        </td>
    </tr>
        @php
        $total_sales_amount += $total_sales[$date];
        @endphp
    @endforeach
    <tr></tr>
    <tr></tr>    
    <tr>
        <th colspan="4">Total Sale Amount</th>
        <th>{{@num_format($total_sales_amount)}}</th>
    </tr>
    </tbody>
</table>
</html>    