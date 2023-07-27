@extends('layouts.app')
@section('title', __('report.stock_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.stock_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
            {!! Form::open(['url' => action('ReportController@getStockSummaryReport'), 'method' => 'get', 'id' => 'stock_summary_filter_form' ]) !!}
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('type', __('product.product_type') . ':') !!}
                            {!! Form::select('type', ['single' => __('lang_v1.single'), 'variable' => __('lang_v1.variable')],
                            null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' =>
                            'summary_product_list_filter_type', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('category_id', __('product.category') . ':') !!}
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2 category_id',
                            'style' =>
                            'width:100%', 'id' => 'summary_product_list_filter_category_id', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                            {!! Form::select('sub_category_id', $sub_categories, null, ['class' => 'form-control select2
                            sub_category_id', 'style' =>
                            'width:100%', 'id' => 'summary_product_list_filter_sub_category_id', 'placeholder' => __('lang_v1.all')]);
                            !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('product_id', __('lang_v1.products') . ':') !!}
                            {!! Form::select('product_id', $products, null, ['class' => 'form-control select2 product_id',
                            'style' =>
                            'width:100%', 'id' => 'summary_product_list_filter_product_id', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('unit_id', __('product.unit') . ':') !!}
                            {!! Form::select('unit_id', $units, null, ['class' => 'form-control select2', 'style' =>
                            'width:100%', 'id' => 'summary_product_list_filter_unit_id', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('tax_id', __('product.tax') . ':') !!}
                            {!! Form::select('tax_id', $taxes, null, ['class' => 'form-control select2', 'style' =>
                            'width:100%', 'id' => 'summary_product_list_filter_tax_id', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('brand_id', __('product.brand') . ':') !!}
                            {!! Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' =>
                            'width:100%', 'id' => 'summary_product_list_filter_brand_id', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3" id="location_filter">
                        <div class="form-group">
                            {!! Form::label('location_id', __('purchase.business_location') . ':') !!}
                            {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2',
                            'style' => 'width:100%', 'id' => 'summary_location_id','placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('store_id', __('lang_v1.store_id').':') !!}
                            <select name="store_id" id="summary_store_id" class="form-control select2" required>
                            <option value="">@lang('lang_v1.all')</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('status', __('lang_v1.status').':') !!}
                            {!! Form::select('active_state', ['active' => __('business.is_active'), 'inactive' =>
                            __('lang_v1.inactive')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' =>
                            'summary_active_state', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    @if($show_manufacturing_data)
                        <div class="col-md-3">
                            <div class="form-group">
                                <br>
                                <div class="checkbox">
                                    <label>
                                    {!! Form::checkbox('only_mfg', 1, false, 
                                    [ 'class' => 'input-icheck', 'id' => 'summary_only_mfg_products']); !!} {{ __('manufacturing::lang.only_mfg_products') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
    @can('view_product_stock_value')
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-solid'])
            <table class="table no-border">
                <tr>
                    <td>@lang('report.closing_stock') (@lang('lang_v1.by_purchase_price'))</td>
                    <td>@lang('report.closing_stock') (@lang('lang_v1.by_sale_price'))</td>
                    <td>@lang('lang_v1.potential_profit')</td>
                    <td>@lang('lang_v1.profit_margin')</td>
                </tr>
                <tr>
                    <td><h3 id="summary_closing_stock_by_pp" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="summary_closing_stock_by_sp" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="summary_potential_profit" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="summary_profit_margin" class="mb-0 mt-0"></h3></td>
                </tr>
            </table>
            @endcomponent
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-solid'])
                @include('report.partials.stock_summary_table')
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection