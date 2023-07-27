@php
  $custom_labels = json_decode(session('business.custom_labels'), true);
  $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
  $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
  $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
  $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
@endphp
<table class="table table-bordered table-striped" id="stock_summary_table" width="100%">
    <thead style="width: 100%">
        <tr>
            <th>@lang('business.product')</th>
            <th>@lang('product.category')</th>
            <th>@lang('sale.location')</th>
            <th>@lang('report.current_stock')</th>
            <th>@lang('report.total_unit_purchased')</th>
            <th>@lang('report.total_unit_sold')</th>
            <th>@lang('report.remarks')</th>
        </tr>
    </thead> 
    <tfoot>
        <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="3"><strong>@lang('sale.total'):</strong></td>
            <td class="footer_total_stock"></td>
            <td></td>
            <td class="footer_total_sold"></td>
            <td></td>
        </tr>
    </tfoot>
</table>