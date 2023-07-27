<!-- Content Header (Page header) -->
<section class="content-header"  style="padding: 5px !important">
    <h1>Review Changes</h1>
</section>

<!-- Main content -->
<section class="content" style="padding-top: 0px !important">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('financial_status_date_range',  'Review date:') !!}
                        {!! Form::text('financial_status_date_range',  null, ['class' => 'form-control', 'readonly' ,'style' => 'width:100%']); !!}
                    </div>
                </div>
               
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
                <div class="table-responsive" id="financial_status_report_table">
                    
                </div>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_review_change" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
