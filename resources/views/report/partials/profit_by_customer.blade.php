<div class="table-responsive">
    <table class="table table-bordered table-striped table-text-center" id="profit_by_customer_table">
        <thead>
            <tr>
                <th>@lang('product.customer')</th>
                <th>@lang('lang_v1.total_sales')</th>
                <th>@lang('lang_v1.gross_profit')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total">
                <td><strong>@lang('sale.total'):</strong></td>
                <td><span class="display_currency footer_total_sales" data-currency_symbol ="true"></span></td>
                <td><span class="display_currency footer_total" data-currency_symbol ="true"></span></td>
            </tr>
        </tfoot>
    </table>
</div>