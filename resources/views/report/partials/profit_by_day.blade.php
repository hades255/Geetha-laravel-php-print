<div class="table-responsive">
    <table class="table table-bordered table-striped table-text-center" id="profit_by_day_table">
        <thead>
            <tr>
                <th>@lang('lang_v1.days')</th>
                <th>@lang('lang_v1.total_sales')</th>
                <th>@lang('lang_v1.gross_profit')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($days as $day)
                <tr>
                    <td>@lang('lang_v1.' . $day)</td>
                    <td><span class="display_currency total-sales" data-currency_symbol="true" data-orig-value="{{$profits[$day]['total_sales'] ?? 0}}">{{$profits[$day]['total_sales'] ?? 0}}</span></td>
                    <td><span class="display_currency gross-profit" data-currency_symbol="true" data-orig-value="{{$profits[$day]['gross_profit'] ?? 0}}">{{$profits[$day]['gross_profit'] ?? 0}}</span></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-gray font-17 footer-total">
                <td><strong>@lang('sale.total'):</strong></td>
                <td><span class="display_currency footer_total_sales" data-currency_symbol ="true"></span></td>
                <td><span class="display_currency footer_total" data-currency_symbol ="true"></span></td>
            </tr>
        </tfoot>
    </table>
</div>

