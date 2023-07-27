<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>{{ __('lang_v1.aging_report')}}</h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('ir_customer_id', __('contact.customer') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        {!! Form::select('ir_customer_id', $customers, null, ['class' => 'form-control select2',
                        'placeholder' => __('lang_v1.all'), 'id' => 'aging_customer_id', 'style' => 'width: 100%;']); !!}
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('route', 'Route :') !!}
                    {!! Form::select('route[]', $routes, null, [
                        'class' => 'form-control select2',
                        'placeholder' => __('lang_v1.all'),
                        'id' => 'aging_route_id',
                        'style' => 'width: 100%;',
                        'multiple' => 'multiple'
                    ]); !!}

                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('no_of_days_over', __('report.enter_no_of_days_over') . ':') !!}
                    {!! Form::text('no_of_days_over', null, ['class' => 'form-control','placeholder' =>
                    __('report.enter_no_of_days_over'), 'id' => 'no_of_days_over']); !!}
                </div>
            </div>
            
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="aging_report_table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>@lang('report.date')</th>
                            <th>@lang('report.customer')</th>
                            <th>Days</th>
                            <th>Route</th>
                            <th>@lang('lang_v1.invoice_no')</th>
                            <th>@lang('report.1_30_days')</th>
                            <th>@lang('report.31_45_days')</th>
                            <th>@lang('report.46_60_days')</th>
                            <th>@lang('report.61_90_days')</th>
                            <th>@lang('report.over_90_days')</th>
                            <th>Total</th>
                            <th class="notexport">@lang('report.action')</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td></td><td></td><td></td><td></td>
                            <td colspan="1"><strong>@lang('sale.total'):</strong></td>
                            
                            <td><span class="display_currency" id="footer_total_1_30" data-currency_symbol ="true"></span></td>
                            
                            <td><span class="display_currency" id="footer_total_31_45" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_46_60" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_61_90" data-currency_symbol ="true"></span></td>
                            
                            <td><span class="display_currency" id="footer_total_90" data-currency_symbol ="true"></span></td>
                            
                            <td><span class="display_currency" id="footer_total_amount_aging" data-currency_symbol ="true"></span></td>
                            
                            <td colspan="1"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
