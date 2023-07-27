@extends('layouts.app')
@section('title', __('chequer_dashboard'))
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('chequer_dashboard')</h1>
</section>

<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary', 'title' => "Chequer Dashboard"])

    @slot('tool')
    <div class="box-tools">
        {{-- <a type="button" class="btn btn-block btn-primary"
            href="{{action('Chequer\ChequeTemplateController@create')}}">
            <i class="fa fa-plus"></i> @lang('messages.add')</a> --}}
    </div>
    @endslot
    
    <div class="container" style="display: flex; justify-content:end;margin-bottom:10px;">
             <!-- <button class="btn btn-primary" onclick="getrecords('today')">Today</button>-->
             <!--<button class="btn btn-primary"  onclick="getrecords('currentweek')">Current Week</button>-->
             <!--<button class="btn btn-primary"  onclick="getrecords('currentmonth')">Current Month</button>-->
             <!--<button class="btn btn-primary"  onclick="getrecords('Previousmonth')">Previous Month</button>-->
             <!--<button class="btn btn-primary"  onclick="getrecords('currentyear')">Current Year</button>-->
             <!--<button class="btn btn-primary"  onclick="getrecords('previousyear')">Previous Year</button>-->
             
             <div class="col-sm-4" style="margin-left: 20px">
                <div class="form-group">
                    <select class="form-control" style="background-color: #5C2AAE;color: #ffffff;width: 100%;" id="period_1">
                        <option value="" selected="selected">Select period</option>
                        <option value="today">Today</option>
                        <option value="currentweek">This Week</option>
                        <option value="currentmonth">This Month</option>
                        <option value="currentyear">This Year</option>
                        <option value="previousyear">Previous Year</option>
                    </select>
                </div>
          </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="templates_table">
            <thead>            
                <tr>
                    <th>#</th>
                    <th>Check Amount</th>
                </tr>
            </thead>
           
            <tbody id="insert">
                  <tr class="product">
                    <td class="product">233</td>
                    <td class="product">233</td>
                </tr>
            </tbody>
        </table>
        <div class="container">
            <div class="d-flex align-iems-ceneter justify-content-center">
                 <div id="below" style="display: none;"> 
               
                 <h3 style="margin-left: 8px;">Total Amount:</h3>
                    <h3 id="total_amount">3445</h3>

                 <h3 style="margin-left: 8px;">Total number of cheques Printed:</h3>
                   <h3 id="total_checks">432</h3> 
                </div>

            </div>
         </div>
    </div>
    @endcomponent
    <div class="modal fade" id="template_link_bank_model" role="dialog"></div>
</section>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        $('#period_1').val("today").change();
        getrecords("today");
    });
    
    $('#period_1').on('change', function() {
        var option = $(this).val();
        getrecords(option);
      });
    
        
      function getrecords(data){
        var data2= data;
        $.ajax({
                url: '{{ url("filter_monthly") }}',
                type: 'POST',
                data: {  
                        "_token": "{{ csrf_token() }}",
                        "data": data2,
                      },
                     success: function(response)
                     {     
                        if(response==0){
                            $('#below').css('display','flex');
                            $('.product').remove(); 
                            $('#total_amount').text(' ');
                            $('#total_checks').text(' ');
                            $('#total_amount').text('0');
                            $('#total_checks').text('0');
                        }else{
                     for(i=0; i<3; i++) {
                       var html= response[0];
                       var total= response[1];
                       var count= response[2];
                     }
                     $('.product').remove(); 
                     $('#total_amount').text(' ');
                     $('#total_checks').text(' ');
                     $('#below').css('display','flex');
                     $('#total_amount').text(total);
                     $('#total_checks').text(count);
                     $('#insert').prepend(html);
                    }
                     }
            });
      }
    // $('#location_id').change(function () {
    //     templates_table.ajax.reload();
    // });
    // //employee list
    // templates_table = $('#templates_table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: {
    //         url: '{{action("Chequer\ChequeTemplateController@index")}}',
    //         data: function (d) {
    //             d.location_id = $('#location_id').val();
    //             // d.contact_type = $('#contact_type').val();
    //         }
    //     },
    //     columns: [
    //         { data: 'id', name: 'id' },
    //         { data: 'template_name', name: 'template_name' },
    //         { data: 'template_size', name: 'template_size' },
    //         { data: 'username', name: 'username' },
    //         { data: 'created_date', name: 'created_date' },
    //         { data: 'action', name: 'action' },
    //     ],
    //     fnDrawCallback: function (oSettings) {
          
    //     },
    // });

    // $(document).on('click', 'a.delete_employee', function(e) {
    //     e.preventDefault();
    //     swal({
    //         title: LANG.sure,
    //         text: 'This template will be deleted.',
    //         icon: 'warning',
    //         buttons: true,
    //         dangerMode: true,
    //     }).then(willDelete => {
    //         if (willDelete) {
    //             var href = $(this).data('href');
    //             var data = $(this).serialize();

    //             $.ajax({
    //                 method: 'DELETE',
    //                 url: href,
    //                 dataType: 'json',
    //                 data: data,
    //                 success: function(result) {
    //                     if (result.success === true) {
    //                         toastr.success(result.msg);
    //                         templates_table.ajax.reload();
    //                     } else {
    //                         toastr.error(result.msg);
    //                     }
    //                 },
    //             });
    //         }
    //     });
    // });
    // $('#filter_business').select2();
    
    // $(document).on('ready',function(){
        
    //     $("#template_link_bank_model").on("show.bs.modal", function(e) {
    //         var link = $(e.relatedTarget);
    //         $(this).load(link.attr("href"));
    //     });
    // });
</script>
@endsection