<!-- Main content -->
<style>
    .larger {
        width: 20px;
        height: 20px;
    }

    .label-style{
        margin-bottom: 5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 11px;
        cursor: pointer;
    }
    .input-style{
        margin-top: 0 !important;
        cursor: pointer;
    }
</style>

<section class="content">

    <div class="row">

        <div class="col-md-12">

            @component('components.widget', ['class' => 'box-primary'])
                @include('report.printing.daily_report_print')

            @endcomponent
            <!--Modified By iftekhar-->
            
        </div>

    </div>
</section>

<!-- /.content -->

<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

