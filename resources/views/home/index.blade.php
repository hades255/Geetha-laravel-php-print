@extends('layouts.app')
@section('title', __('home.home'))

@section('content')

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left" style="margin-top: 15px">
                    <li><a href="#">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if($home_dashboard)
@if(auth()->user()->can('dashboard.data'))
<!-- Main content -->
<section class="content main-content-inner no-print">
    <div class="row">
      
      <div class="col-sm-3 pull-right">
        <div class="form-group">
            <select class="form-control" style="background-color: #5C2AAE;color: #ffffff;width: 100%;" id="type">
                <option value="category" selected="selected">Category wise</option>
                <option value="sub">Sub Category wise</option> 
            </select>
        </div>
      </div>
      
      <div class="col-sm-3 pull-right" style="margin-left: 20px">
        <div class="form-group">
            <select class="form-control" style="background-color: #5C2AAE;color: #ffffff;width: 100%;" id="period_1">
                <option value="" selected="selected">Select period</option>
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
                <option value="year">This Year</option>
                <option value="financial-year">Financial Year</option>
            </select> 
        </div>
      </div>
      
  </div>
          
  <div class="row" style="margin-top: 0px">
      <div class="col-sm-6">
          <div class="row">
              <div class="col-sm-5"></div>
              <div class="col-sm-4" style="margin-left: 20px">
                
              </div>
          </div>
          <div class="row">
              <div class="col-sm-1"></div>
              <div class="col-sm-4" style="color:#fff; background-color: #311B92">
                  <h5><strong>Purchases</strong></h5>
                  @if(auth()->user()->can('DashboardSummaryCards'))<h5 id="purchases">0.0</h5> @endif
              </div>
              <div class="col-sm-4 " style="margin-left: 20px;background-color: #2E7D32;color: #fff">
                  <h5><strong>Sales</strong></h5>
                  @if(auth()->user()->can('DashboardSummaryCards'))<h5 id="sales">0.0</h5> @endif
              </div>
          </div>
          
          <div class="row" style="margin-top: 20px">
              <div class="col-sm-1"></div>
              <div class="col-sm-4" style="color: #fff; background-color:#B56101">
                  <h5><strong>Stocks</strong></h5>
                  @if(auth()->user()->can('DashboardSummaryCards'))<h5 id="stocks">0.0</h5> @endif
              </div>
              <div class="col-sm-4 " style="margin-left: 20px; color: white;
              background-color: #D32F2F">
                  <h5><strong>Expenses</strong></h5>
                  @if(auth()->user()->can('DashboardSummaryCards'))<h5 id="expenses">0.0</h5> @endif
              </div>
          </div>
          
          <div class="row" style="margin-top: 20px">
              <div class="col-sm-1"></div>
              <div class="col-sm-4" style="color:#fff; background-color: #00a3e8">
                  <h5><strong>Credit given</strong></h5>
                  @if(auth()->user()->can('DashboardSummaryCards'))<h5 id="credit_given">0.0</h5> @endif
              </div>
              <div class="col-sm-4 bg-primary " style="margin-left: 20px; color: #fff;background-color: #dcb612">
                  <h5><strong>Credit received</strong></h5>
                  @if(auth()->user()->can('DashboardSummaryCards'))<h5 id="credit_received" >0.0</h5> @endif
              </div>
          </div>
          
      </div>
      <div class="col-sm-6">
          <div class="row">
              <div class="col-sm-6">
                  <div class="card"  style="border: 1px solid #D9D8D8">
                      <canvas id="seolinechart8" style="margin-top: 0px !important" height="200"></canvas>
                  </div>
                  
              </div>
              
              <div class="col-sm-6">
                  <div class="card"  style="border: 1px solid #D9D8D8">
                      <canvas id="product_sub" style="margin-top: 0px !important" height="200"></canvas>
                  </div>
                  
              </div>
              
          </div>
      </div>
      
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-12 card" style="background-color: #fff;border: 1px solid #D9D8D8">
        <div id="ambarchart3" height="300" ></div>
    </div>
    <div class="col-sm-12">
        <div class="card bg-light text-dark"  style="border: 1px solid #D9D8D8">
            <div id="ambarchart1" height="300"></div>
        </div> 
        
    </div>
</div>

<hr>

<div class="row" style="margin-top: 10px;margin-bottom: 50px">
    <div class="col-sm-6">
        <div class="card bg-light text-dark"  style="border: 1px solid #D9D8D8">
            <canvas id="payments_current" style="margin-top: 0px !important" height="100"></canvas>
        </div>
        
    </div>
    
    <div class="col-sm-6 bg-light text-dark">
        <div class="card" style="border: 1px solid #D9D8D8">
            <canvas id="payments_previous" style="margin-top: 0px !important" height="100"></canvas>
        </div>
        
    </div>
    
</div>

</section>
<!-- /.content -->



@stop
@section('javascript')
<script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
 <!-- start chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

<!-- start amcharts -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script>
    var paymentColors = [
                        "#8919FE",
                        "#12C498",
                        "#F8CB3F",
                        "#E36D68"
                    ];
    
    var prevpaymentColors = [
                        "#8919FE",
                        "#12C498",
                        "#F8CB3F",
                        "#E36D68"
                    ];
    
    var productsColors = [
                        "#8919FE",
                        "#12C498",
                        "#F8CB3F",
                        "#E36D68"
                    ];
    var glanceDenied = false;
    var layeredDenied = false;
</script>
@if(!auth()->user()->can('DashboardPaymentMethods'))
    <script>
        paymentColors = ["#12C498","#12C498","#12C498","#12C498"];
    </script>
@endif


@if(!auth()->user()->can('DashboardProductCategories'))
    <script>
        productsColors = ["#B56101","#B56101","#B56101","#B56101"];
    </script>
@endif

@if(!auth()->user()->can('DashboardGlance'))
    <script>
        glanceDenied = true;
    </script>
@endif

@if(!auth()->user()->can('DashboardCurrentPastGraph'))
    <script>
        layeredDenied = true;
    </script>
@endif

@if(!auth()->user()->can('DashboardCurrentPastPayments'))
    <script>
        prevpaymentColors = ["#12C498","#12C498","#12C498","#12C498"];
    </script>
@endif


<script>
    $(document).ready(function(){
        $('#period_1').val("month").change();
        loadData("month");
    
    function createPiechart(chartdata){
        
        var ctx = document.getElementById("seolinechart8").getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                labels: ["Cash", "Credit cards", "Credit sales", "Shortages"],
                datasets: [{
                    backgroundColor: paymentColors,
                    borderColor: '#fff',
                    data: chartdata,
                }]
            },
            // Configuration options go here
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return value.toLocaleString('en-US', {minimumFractionDigits: 2});
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Payment Methods'
                },

                legend: {
                    display: true,
                    markerSize: 10
                },
                animation: {
                    easing: "easeInOutBack"
                }
            }
        });
    }
    
    function productsub(labels,chartdata){
        var ctx = document.getElementById("product_sub").getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                labels: labels,
                datasets: [{
                    backgroundColor: productsColors,
                    borderColor: '#fff',
                    data: chartdata,
                }]
            },
            // Configuration options go here
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return value.toLocaleString('en-US', {minimumFractionDigits: 2});
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Products Categories'
                },

                legend: {
                    display: true,
                    markerSize: 10
                },
                animation: {
                    easing: "easeInOutBack"
                }
            }
        });
    }
    
    function current_payments_pie(chartdata){
        var ctx = document.getElementById("payments_current").getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                labels: ["Cash", "Credit cards", "Credit sales", "Shortages"],
                datasets: [{
                    backgroundColor: prevpaymentColors,
                    borderColor: '#fff',
                    data: chartdata,
                }]
            },
            // Configuration options go here
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return value.toLocaleString('en-US', {minimumFractionDigits: 2});
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Payment Methods'
                },

                legend: {
                    display: true,
                    markerSize: 10
                },
                animation: {
                    easing: "easeInOutBack"
                }
            }
        });
    }
    
    
    function layered(chartdata,title,divider){
        if(layeredDenied == true){
            chartdata = JSON.stringify([
                {"type":"Purchases","This":25000,"Last":25000,"color":"#bfbffd","color2":"#7474F0"},
                {"type":"Sales","This":25000,"Last":25000,"color":"#bfbffd","color2":"#7474F0"},
                {"type":"Stocks","This":25000,"Last":25000,"color":"#bfbffd","color2":"#7474F0"},
                {"type":"Expenses","This":25000,"Last":25000,"color":"#bfbffd","color2":"#7474F0"},
                {"type":"Credit Given","This":25000,"Last":25000,"color":"#bfbffd","color2":"#7474F0"},
                {"type":"Credit Received","This":25000,"Last":25000,"color":"#bfbffd","color2":"#7474F0"}
            ]);
        }
        var chart = AmCharts.makeChart("ambarchart1", {
        "theme": "light",
        "type": "serial",
        "balloon": {
            "adjustBorderColor": false,
            "horizontalPadding": 10,
            "verticalPadding": 4,
            "color": "#fff"
        },
        "dataProvider": JSON.parse(chartdata),
        "numberFormatter" : {
            "precision":2, 
            "decimalSeparator":'.', 
            "thousandsSeparator":','
        },
        "valueAxes": [{
            "unit": "",
            "position": "left",
            "gridThickness": 0
            
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": divider == "year" ? "Last "+title +"[[category]] : <b>[[value]]</b>" : "Last "+title +"[[category]] : <b>[[value]] (000)</b>",
            "fillAlphas": 0.9,
            "fillColorsField": "color",
            "fillColors": "#bfbffd",
            "lineAlpha": 0.2,
            "title": "Last "+title,
            "type": "column",
            "valueField": "Last"
        }, {
            "balloonText":  divider == "year" ? "This "+title + "[[category]] : <b>[[value]]</b>" : "This "+title + "[[category]] : <b>[[value]] (000)</b>",
            "fillAlphas": 0.9,
            "fillColorsField": "color2",
            "fillColors": "#7474F0",
            "lineAlpha": 0.2,
            "title": "This "+title,
            "type": "column",
            "clustered": false,
            "columnWidth": 0.5,
            "valueField": "This"
        }],
        "plotAreaFillAlphas": 0.1,
        "legend": {
            "useGraphSettings": true,
            "markerSize": 10
        },

        "categoryField": "type",
        "categoryAxis": {
            "gridPosition": "start",
            "gridAlpha": 0,
        },
        "export": {
            "enabled": false
        }

    });
    }
    
    function previous_payments_pie(chartdata,title){
        var ctx = document.getElementById("payments_previous").getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                labels: ["Cash", "Credit cards", "Credit sales", "Shortages"],
                datasets: [{
                    backgroundColor: prevpaymentColors,
                    borderColor: '#fff',
                    data: chartdata,
                }]
            },
            // Configuration options go here
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return value.toLocaleString('en-US', {minimumFractionDigits: 2});
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Payment Methods ( Last ' + title + ')'
                },

                legend: {
                    display: true,
                    markerSize: 10
                },
                animation: {
                    easing: "easeInOutBack"
                }
            }
        });
    }
    
    function createBarchart(chartdata,title){
        
        if(glanceDenied == true){
            chartdata = [{year: "", purchases: 15000,sales : 15000, stocks : 15000, expenses : 15000}];
        }
        
        
        var barchart = AmCharts.makeChart("ambarchart3", {
        "type": "serial",
        "theme": "light",
        "columnWidth": 1,
        "categoryField": "year",
        "rotate": false,
        "startDuration": 1,
        "categoryAxis": {
            "gridPosition": "start",
            "position": "bottom",
            "gridThickness": 0
        },
        "trendLines": [],
        "graphs": [{
                "balloonText": "Purchases:[[value]]",
                "fillAlphas": 0.8,
                "id": "AmGraph-1",
                "lineAlpha": 0.2,
                "title": "Purchases",
                "type": "column",
                "valueField": "purchases",
                "fillColors": "#311B92",
                 "maxBarWidth": 1
            },
            {
                "balloonText": "Sales:[[value]]",
                "fillAlphas": 0.8,
                "id": "AmGraph-2",
                "lineAlpha": 0.2,
                "title": "Sales",
                "type": "column",
                "valueField": "sales",
                "fillColors": "#2E7D32",
                 "maxBarWidth": 1
            },
            {
                "balloonText": title == "year" ? "Stocks:[[value]]" : "Stocks:[[value]] (000)" ,
                "fillAlphas": 0.8,
                "id": "AmGraph-3",
                "lineAlpha": 0.2,
                "title": "Stocks",
                "type": "column",
                "valueField": "stocks",
                "fillColors": "#B56101",
                 "maxBarWidth": 1
            },
            {
                "balloonText": "Expenses:[[value]]",
                "fillAlphas": 0.8,
                "id": "AmGraph-4",
                "lineAlpha": 0.2,
                "title": "Expenses",
                "type": "column",
                "valueField": "expenses",
                "fillColors": "#D32F2F",
                 "maxBarWidth": 1
            }
        ],
        "guides": [],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "position": "left",
            "gridThickness": 0
        }],
        "allLabels": [],
        "balloon": {},
        "titles": [],
        "legend": {
            "labelColorField": "color", // Set the legend label color to the same color as the graph
            "valueWidth": 0,
           
            "align": "center",
            "autoMargins": false,
            "switchType": "v",
            "equalWidths": true,
            "useGraphSettings": true
          },
        "dataProvider": chartdata,
        "numberFormatter" : {
            "precision":2, 
            "decimalSeparator":'.', 
            "thousandsSeparator":','
        },
        "export": {
            "enabled": false
        },
        "titles": [{
            "text": "At a Glance",
            "position": "top"
        }],

    });
        
    }
    
    
    function loadData(option){
        
        
        var loading = "<span>Loading...</span>";
            $("#sales").html(loading);
            $("#credit_given").html(loading);
            $("#credit_received").html(loading);
            $("#purchases").html(loading);
            $("#expenses").html(loading);
            $("#stocks").html(loading);
                
            $.ajax({
              url: "{{action('HomeController@index')}}" , 
              type: 'GET', 
              data: {filter: option, 'type' : $("#type").val()},
              success: function(data) {
                  var data = JSON.parse(data);
                  
                  $('#period_2').val(option).change();
                   
                    $("#sales").html(data['sales']);
                    $("#credit_given").html(data['credit_given']);
                    $("#purchases").html(data['purchases']);
                    $("#expenses").html(data['expenses']);
                    $("#stocks").html(data['stocks']);
                    $("#credit_received").html(data['credit_received']);
                    
                    
                    // Add new data to chart
                    createBarchart(JSON.parse(data['bar_char']),option);
                    createPiechart(data['pie_chart']);
                    current_payments_pie(data['pie_curr']);
                    previous_payments_pie(data['pie_prev'],data['prev_title']);
                    // console.log(data['layered']);
                    layered(data['layered'],data['prev_title'],option)
                    
                    productsub(data['topcatsVal'],data['topcatsLab']);
                    
                    // barchart.validateData();
                    
              },
              error: function() {
                
              }
            });
    }
    
    
            $(document).on('change', '#type,#period_1', function() {
                    var option = $('#period_1').val();
                    loadData(option);
            });
       
        
    });

</script>


@if(!empty($all_locations))
{!! $sells_chart_1->script() !!}
{!! $sells_chart_2->script() !!}
@endif

@if(!empty($customer_name_payment))
<script>
  swal({
      title: 'Payment Received',
      text: 'Pending direct payment is Done by {{$customer_name_payment}}. Please check and approve.',
      icon: 'success',
      buttons: true,
      dangerMode: false,
  })
</script>
@endif
@endif
@endif
@endsection
