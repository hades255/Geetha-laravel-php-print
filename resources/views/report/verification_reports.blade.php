@extends('layouts.app')
@section('title', __('report.verification_reports'))

<!-- Main content -->
@section('content')
<section class="content"  style="padding-top: 0px !important">
    <div class="row">
        <div class="col-md-12">
            <div class="settlement_tabs">
                <ul class="nav nav-tabs">
                    <form id="export_report" action="{{url('reports/montly-report')}}" method="get"></form>
                    @if($permission['monthly_report'])
                    @can('monthly_report.view')
                    <li class="active"  style="margin-top: 0px !important">
                        <a href="#monthly_report" class="monthly_report" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('report.monthly_report')</strong>
                        </a>
                    </li>
                    @endcan
                    @endif
                    

                    @if($permission['comparison_report'])
                    @can('comparison_report.view')
                    <li class=""  style="margin-top: 0px !important">
                        <a href="#comparison_report" class="comparison_report" data-toggle="tab">
                            <i class="fa fa-file-text-o"></i> <strong>@lang('report.comparison_report')</strong>
                        </a>
                    </li>
                    @endcan
                    @endif
                </ul>
                <div class="tab-content"  style="padding-top: 0px !important">
                    @if($permission['monthly_report'])
                    @can('monthly_report.view')
                    <div class="tab-pane active" id="monthly_report" style="margin-top: 0px !important; padding-bottom: 0px !important;">
                        @include('report.partials.monthly_report_header')
                    </div>
                    @endcan
                    @endif

                    @if($permission['comparison_report'])
                    @can('comparison_report.view')
                    <div class="tab-pane" id="comparison_report" style="margin-top: 0px !important; padding-bottom: 0px !important;">
                        @include('report.partials.comparison_report_header')
                    </div>
                    @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>

</section>

<!-- /.content -->
@endsection
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>

<script>
getMonthlyReport();
    $('.monthly_report_change').change(function(){
        getMonthlyReport();
    });
    $(document).ready(function() {
      // Set initial date range to current month
      dateRangeSettings.startDate = moment().startOf('month');
      dateRangeSettings.endDate = moment().endOf('month');
    
      // Initialize daterangepicker and set the selected date range
      $('#monthly_report_date_rage').daterangepicker(dateRangeSettings, function(start, end) {
        $('#monthly_report_date_rage').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        getMonthlyReport();
      });
    
      // Clear the selected date range on cancel
      $('#monthly_report_date_rage').on('cancel.daterangepicker', function(ev, picker) {
        $('#monthly_report_date_rage').val('');
      });
    });


    function getMonthlyReport(){
        var location_id = $('#monthly_report_location_id').val();
        var work_shift = $('#monthly_report_work_shift').val();
        // @eng START 14/2
        // var start_month = $('#monthly_report_start_month').val(); 
        // var end_month = $('#monthly_report_end_month').val();
        // var year = $('#monthly_report_year').val();

        var start_month = '';
        var end_month = ''
        var year ='';
        var start_date = "";
        var end_date = "";
        
        if($('#monthly_report_date_rage').val()){
            start_month = $('input#monthly_report_date_rage').data('daterangepicker').startDate.format('MM');
            end_month = $('input#monthly_report_date_rage').data('daterangepicker').endDate.format('MM');
            year = $('input#monthly_report_date_rage').data('daterangepicker').endDate.format('YYYY');
            
            start_date = $('input#monthly_report_date_rage').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end_date = $('input#monthly_report_date_rage').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }
        // @eng END 14/2

        var dsr_loader = '<div class="row text-center"><i class="fa fa-refresh fa-spin fa-fw margin-bottom"></i></div>';
        $('.monthly_report_content').html(dsr_loader);
        
      
        
        $.ajax({
            method: 'get',
            url: "{{url('/reports/montly-report')}}",
            data: { 
                 location_id,
                work_shift,
                start_month,
                end_month,
                year,
                start_date,
                end_date
             },
             contentType: 'html',
            success: function(result) {
                $('.monthly_report_content').empty().append(result);
            },
        });
    }

    function printMonthlyReport() {
		var w = window.open('', '_self');
		var html = document.getElementById("monthly_report_div").innerHTML;
		$(w.document.body).html(html);
		w.print();
        w.close();
        location.reload();
	}

    if ($('#comparison_date_range_one').length == 1) {
        $('#comparison_date_range_one').daterangepicker(dateRangeSettings, function(start, end) {
            $('#comparison_date_range_one span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
             getComparisonReport();
        });
        $('#comparison_date_range_one').on('cancel.daterangepicker', function(ev, picker) {
            $('#comparison_date_range_one').val('');
             getComparisonReport();
        });
    }


    if ($('#comparison_date_range_two').length == 1) {
        $('#comparison_date_range_two').daterangepicker(dateRangeSettings, function(start, end) {
            $('#comparison_date_range_two span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
             getComparisonReport();
        });
        $('#comparison_date_range_two').on('cancel.daterangepicker', function(ev, picker) {
            $('#comparison_date_range_two').val('');
             getComparisonReport();
        });
    }

    $('#comparison_date_range_one,  #comparison_date_range_two').change(function(){
        getComparisonReport()
    })

    function getComparisonReport(){
        var start_date_one = $('#comparison_date_range_one').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end_date_one = $('#comparison_date_range_one').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var start_date_two = $('#comparison_date_range_two').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end_date_two = $('#comparison_date_range_two').data('daterangepicker').endDate.format('YYYY-MM-DD');

        var dsr_loader = '<div class="row text-center"><i class="fa fa-refresh fa-spin fa-fw margin-bottom"></i></div>';
        $('.comparison_report_div').html(dsr_loader);

        $.ajax({
            method: 'get',
            url: '/reports/comparison-report',
            data: { 
                start_date_one,
                end_date_one,
                start_date_two,
                end_date_two,
             },
             contentType: 'html',
            success: function(result) {
                $('.comparison_report_div').empty().append(result);
            },
        });
    }

    function generateExcel(type){
        console.log(type,'sdfsdf')
        var location_id = $('#monthly_report_location_id').val();
        var work_shift = $('#monthly_report_work_shift').val();
        var start_month = '';
        var end_month = '';
        var year = '';
        if(type == "monthly"){
            let path = `{{url('reports/montly-report')}}?location_id=${location_id}&work_shift=${work_shift}&start_month=${start_month}&end_month=${end_month}&year=${year}`
            let form = $("#export_report")
            form.empty()
            let inp = `<input type="hidden" name="location_id" value="${location_id}">`
            inp+=`<input type="hidden" name="work_shift" value="${work_shift}">`
            inp+=`<input type="hidden" name="start_month" value="${start_month}">`
            inp+=`<input type="hidden" name="end_month" value="${end_month}">`
            inp+=`<input type="hidden" name="year" value="${year}">`
            form.append($(inp))
            form.submit()
        }
    }

</script>

@endsection