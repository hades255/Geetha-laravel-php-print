@if($account_access)
<style>
  .sub_tables_rows {
    display: none;
  }
</style>



<div class="col-sm-12">
  <br>
  <table class="table table-bordered table-striped" id="other_account_table" style="width: 100%;">
    <thead>
      <tr>
        <th></th>
        <th>{{ \Carbon::parse($dates['first'])->format('M Y') }}</th>
        <th>{{ \Carbon::parse($dates['second'])->format('M Y') }}</th>
        <th>{{ \Carbon::parse($dates['third'])->format('M Y') }}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @php
          $first_income_total = 0;
          $second_income_total = 0;
          $third_income_total = 0;
        @endphp
        @foreach ($income_details as $key => $income_detail)
          @php
            $first_income_total += $income_detail['first'];
            $second_income_total += $income_detail['second'];
            $third_income_total += $income_detail['third'];
          @endphp
        @endforeach
        <td>
          <a data-toggle="collapse" data-parent="#accordion" href="income" class="text-black toggleSubRows"><i class="fa fa-plus-square-o text-red"></i>
            <b>@lang('account.income') </b>
          </a>
        </td>
        <td>{{@number_format($first_income_total,2)}}</td>
        <td>{{@number_format($second_income_total,2)}}</td>
        <td>{{@number_format($third_income_total,2)}}</td>
      </tr>

      @foreach ($income_details as $key => $income_detail)
        <tr class="income sub_tables_rows">
          <td>{{$key}}</td>
          <td> {{@number_format($income_detail['first'],2)}} </td>
          <td> {{@number_format($income_detail['second'],2)}} </td>
          <td> {{@number_format($income_detail['third'],2)}} </td>
        </tr>
      @endforeach
            
      

      
                                                                                          
      <tr>
        @php
          $first_cost_total = 0;
          $second_cost_total = 0;
          $third_cost_total = 0;
        @endphp
         @foreach ($cost_details as $key => $cost_detail)
          @php
            $first_cost_total += $cost_detail['first'];
            $second_cost_total += $cost_detail['second'];
            $third_cost_total += $cost_detail['third'];
          @endphp
        @endforeach
        <td>
          <a data-toggle="collapse" data-parent="#accordion" href="cost_of_sales" class="text-black toggleSubRows"><i class="fa fa-plus-square-o text-red"></i>
            <b>@lang('account.cost_of_sales') </b>
          </a>
        </td>
        <td>{{@number_format($first_cost_total,2)}}</td>
        <td>{{@number_format($second_cost_total,2)}}</td>
        <td>{{@number_format($third_cost_total,2)}}</td>
      </tr>

      @foreach ($cost_details as $key => $cost_detail)
        <tr class="cost_of_sales sub_tables_rows">
          <td>{{$key}}</td>
          <td> {{@number_format($cost_detail['first'],2)}}</td>
          <td>{{@number_format($cost_detail['second'],2)}}</td>
          <td>{{@number_format($cost_detail['third'],2)}}</td>
        </tr>
      @endforeach
        
      
                              
      <tr>
        @php
          $first_direct_total = 0;
          $second_direct_total = 0;
          $third_direct_total = 0;
        @endphp
          @foreach ($direct_expenses as $key => $direct_detail)
            @php
              $first_direct_total += $direct_detail['first'];
              $second_direct_total += $direct_detail['second'];
              $third_direct_total += $direct_detail['third'];
            @endphp
          @endforeach
        <td>
          <a data-toggle="collapse" data-parent="#accordion" href="direct_expenses" class="text-black toggleSubRows"><i class="fa fa-plus-square-o text-red"></i>
            <b>@lang('account.direct_expense')</b>
          </a>
        </td>
        <td>{{@number_format($first_direct_total,2)}}</td>
        <td>{{@number_format($second_direct_total,2)}}</td>
        <td>{{@number_format($third_direct_total,2)}}</td>
      </tr>

      @foreach ($direct_expenses as $key => $direct_detail)
        <tr class="direct_expenses sub_tables_rows">
          <td>{{$key}}</td>
          <td> {{@number_format($direct_detail['first'],2)}}</td>
          <td>{{@number_format($direct_detail['second'],2)}}</td>
          <td>{{@number_format($direct_detail['third'],2)}}</td>
        </tr>
      @endforeach
            
      <tr>
        @php
          $first_gross_profit = $gross_profit['first'];
          $second_gross_profit = $gross_profit['second'];
          $third_gross_profit = $gross_profit['third'];
        @endphp
        <td>
          <a data-toggle="collapse" data-parent="#accordion" href="gross_profit" class="text-black toggleSubRows"><i class="fa fa-plus-square-o text-red"></i>
            <b>@lang('account.gross_profit') </b>
          </a>
        </td>
        <td>{{@number_format($gross_profit['first'],2)}}</td>
        <td>{{@number_format($gross_profit['second'],2)}}</td>
        <td>{{@number_format($gross_profit['third'],2)}}</td>
      </tr>

      
                                                      
      <tr>
        @php
          $first_operating_expense_total = 0;
          $second_operating_expense_total = 0;
          $third_operating_expense_total = 0;
        @endphp
        @foreach ($operating_expense_details as $key => $expense_detail)
          @php
            $first_operating_expense_total += $expense_detail['first'];
            $second_operating_expense_total += $expense_detail['second'];
            $third_operating_expense_total += $expense_detail['third'];
          @endphp 
        @endforeach
        <td>
          <a data-toggle="collapse" data-parent="#accordion" href="operating_expenses" class="text-black toggleSubRows"><i class="fa fa-plus-square-o text-red"></i>
            <b>@lang('account.operating_expenses')</b>
          </a>
        </td>
        <td>{{@number_format($first_operating_expense_total,2)}}</td>
        <td>{{@number_format($second_operating_expense_total,2)}}</td>
        <td>{{@number_format($third_operating_expense_total,2)}}</td>
      </tr>

      @foreach ($operating_expense_details as $key => $expense_detail)
        <tr class="operating_expenses sub_tables_rows">
          <td>{{$key}}</td>
          <td> {{@number_format($expense_detail['first'],2)}}</td>
          <td> {{@number_format($expense_detail['second'],2)}}</td>
          <td> {{@number_format($expense_detail['third'],2)}}</td>
        </tr>
      @endforeach
      
      <tr>
        @php
          $first_net_profit_profit = $first_gross_profit - $first_operating_expense_total;
          $second_net_profit_profit = $second_gross_profit - $second_operating_expense_total;
          $third_net_profit_profit = $third_gross_profit - $third_operating_expense_total;
        @endphp
        <td><a data-toggle="collapse" data-parent="#accordion" href="net_profit" class="text-black toggleSubRows">
            <b>@lang('account.net_profit_before_tax')</b>
          </a></td>
        <td>{{@number_format($first_net_profit_profit,2)}}</td>
        <td>{{@number_format($second_net_profit_profit,2)}}</td>
        <td>{{@number_format($third_net_profit_profit,2)}}</td>
      </tr>

      
      
      <tr>
        @php
          $first_tax_total = 0;
          $second_tax_total = 0;
          $third_tax_total = 0;
        @endphp
          @foreach ($tax_details as $key => $tax_detail)
            @php
              $first_tax_total += $tax_detail['first'];
              $second_tax_total += $tax_detail['second'];
              $third_tax_total += $tax_detail['third'];
            @endphp
          @endforeach
        <td>
          <a data-toggle="collapse" data-parent="#accordion" href="total_taxes" class="text-black toggleSubRows"><i class="fa fa-plus-square-o text-red"></i>
            <b>@lang('account.taxes') </b>
          </a>
        </td>
        <td>{{@number_format($first_tax_total,2)}}</td>
        <td>{{@number_format($second_tax_total,2)}}</td>
        <td>{{@number_format($third_tax_total,2)}}</td>
      </tr>

      @foreach ($tax_details as $key => $tax_detail)
        <tr class="total_taxes sub_tables_rows">
          <td>{{$key}}</td>
          <td> {{@number_format($tax_detail['first'],2)}}</td>
          <td> {{@number_format($tax_detail['second'],2)}}</td>
          <td> {{@number_format($tax_detail['third'],2)}}</td>
        </tr>
      @endforeach

      

      
      <tr>
        @php
          $first_net_profit_after_tax = $first_net_profit_profit - $first_tax_total;
          $second_net_profit_after_tax = $second_net_profit_profit - $second_tax_total;
          $third_net_profit_after_tax = $third_net_profit_profit - $third_tax_total;
        @endphp
        <td>
          <a data-toggle="collapse" data-parent="#accordion" href="net_profit" class="text-black toggleSubRows">
            <b>@lang('account.net_profit_after_tax')</b>
          </a>
        </td>
        <td>{{@number_format($first_net_profit_after_tax,2)}}</td>
        <td>{{@number_format($second_net_profit_after_tax,2)}}</td>
        <td>{{@number_format($third_net_profit_after_tax,2)}}</td>
      </tr>

    </tbody>
  </table>
</div>

<script>
  $('#other_account_table').DataTable({
    "ordering": false,
    "pageLength": 300

  });
  $(".toggleSubRows").click(function() {
    var targetClass = $(this).attr('href');
    $("." + targetClass).toggle();
  });
</script>
{{-- <div class="">
  @php
  $first_income_total = 0;
  $second_income_total = 0;
  $third_income_total = 0;
  @endphp
  <div class="box-header with-border">
      <div class="col-md-6  p-5">
        <a data-toggle="collapse" data-parent="#accordion" href="#income" class="text-black"><i class="fa fa-plus-square-o text-red"></i>
         <b>@lang('account.income')</b>
        </a>
      </div>
      @foreach ($income_details as $key => $income_detail)
      @php
      $first_income_total += $income_detail['first'];
      $second_income_total += $income_detail['second'];
      $third_income_total += $income_detail['third'];
      @endphp
      @endforeach
      <div class="col-md-2  p-5">
        <span class="text-blue"><b>{{@number_format($first_income_total,2)}}</b></span>
      </div>
      <div class="col-md-2  p-5">
       <span class="text-blue"><b>{{@number_format($second_income_total,2)}}</b></span>
      </div>
      <div class="col-md-2  p-5">
        <span class="text-blue"><b>{{@number_format($third_income_total,2)}}</b></span>
      </div>
  </div>
  <div id="income" class="panel-collapse collapse">
    <div class="box-body">
        @foreach ($income_details as $key => $income_detail)
        <div class="col-md-6 p-5">
          {{$key}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($income_detail['first'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($income_detail['second'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($income_detail['third'],2)}}
        </div>
        @endforeach
    </div>
  </div>
</div>

<div class="">
  @php
  $first_cost_total = 0;
  $second_cost_total = 0;
  $third_cost_total = 0;
  @endphp
  <div class="box-header with-border">
      <div class="col-md-6 p-5">
        <a data-toggle="collapse" data-parent="#accordion" href="#cost_of_sales" class="text-black"><i class="fa fa-plus-square-o text-red"></i>
         <b>@lang('account.cost_of_sales')</b>
        </a>
      </div>
      @foreach ($cost_details as $key => $cost_detail)
      @php
      $first_cost_total += $cost_detail['first'];
      $second_cost_total += $cost_detail['second'];
      $third_cost_total += $cost_detail['third'];
      @endphp
      @endforeach
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($first_cost_total,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
       <span class="text-blue"><b>{{@number_format($second_cost_total,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($third_cost_total,2)}}</b></span>
      </div>
  </div>
  <div id="cost_of_sales" class="panel-collapse collapse">
    <div class="box-body">
        @foreach ($cost_details as $key => $cost_detail)
        <div class="col-md-6 p-5">
          {{$key}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($cost_detail['first'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($cost_detail['second'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($cost_detail['third'],2)}}
        </div>
        @endforeach
    </div>
  </div>
</div>


<div class="">
  @php
  $first_direct_total = 0;
  $second_direct_total = 0;
  $third_direct_total = 0;
  @endphp
  <div class="box-header with-border">
      <div class="col-md-6 p-5">
        <a data-toggle="collapse" data-parent="#accordion" href="#direct_expenses" class="text-black"><i class="fa fa-plus-square-o text-red"></i>
         <b>@lang('account.direct_expense')</b>
        </a>
      </div>
      @foreach ($direct_expenses as $key => $direct_detail)
      @php
      $first_direct_total += $direct_detail['first'];
      $second_direct_total += $direct_detail['second'];
      $third_direct_total += $direct_detail['third'];
      @endphp
      @endforeach
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($first_direct_total,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
       <span class="text-blue"><b>{{@number_format($second_direct_total,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($third_direct_total,2)}}</b></span>
      </div>
  </div>
  <div id="direct_expenses" class="panel-collapse collapse">
    <div class="box-body">
        @foreach ($direct_expenses as $key => $direct_detail)
        <div class="col-md-6 p-5">
          {{$key}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($direct_detail['first'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($direct_detail['second'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($direct_detail['third'],2)}}
        </div>
        @endforeach
    </div>
  </div>
</div>

<div class="">
  @php
  $first_gross_profit = $gross_profit['first'];
  $second_gross_profit = $gross_profit['second'];
  $third_gross_profit = $gross_profit['third'];
  @endphp
  <div class="box-header with-border">
      <div class="col-md-6 p-5">
        <a data-toggle="collapse" data-parent="#accordion" href="#gross_profit" class="text-red"><i class="fa fa-plus-square-o text-red"></i>
         <b>@lang('account.gross_profit')</b>
        </a>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($gross_profit['first'],2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
       <span class="text-blue"><b>{{@number_format($gross_profit['second'],2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($gross_profit['third'],2)}}</b></span>
      </div>
  </div>
</div>

<div class="">
  @php
  $first_operating_expense_total = 0;
  $second_operating_expense_total = 0;
  $third_operating_expense_total = 0;
  @endphp
  <div class="box-header with-border">
      <div class="col-md-6 p-5">
        <a data-toggle="collapse" data-parent="#accordion" href="#operating_expenses" class="text-black"><i class="fa fa-plus-square-o text-red"></i>
         <b>@lang('account.operating_expenses')</b>
        </a>
      </div>
      @foreach ($operating_expense_details as $key => $expense_detail)
      @php
      $first_operating_expense_total += $expense_detail['first'];
      $second_operating_expense_total += $expense_detail['second'];
      $third_operating_expense_total += $expense_detail['third'];
      @endphp
      @endforeach
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($first_operating_expense_total,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
       <span class="text-blue"><b>{{@number_format($second_operating_expense_total,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($third_operating_expense_total,2)}}</b></span>
      </div>
  </div>
  <div id="operating_expenses" class="panel-collapse collapse">
    <div class="box-body">
        @foreach ($operating_expense_details as $key => $expense_detail)
        <div class="col-md-6 p-5">
          {{$key}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($expense_detail['first'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($expense_detail['second'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($expense_detail['third'],2)}}
        </div>
        @endforeach
    </div>
  </div>
</div>


<div class="">
  @php
  $first_net_profit_profit = $first_gross_profit - $first_operating_expense_total;
  $second_net_profit_profit = $second_gross_profit - $second_operating_expense_total;
  $third_net_profit_profit = $third_gross_profit - $third_operating_expense_total;
  @endphp
  <div class="box-header with-border">
      <div class="col-md-6 p-5">
        <a data-toggle="collapse" data-parent="#net_profit_before_tax" href="#net_profit_before_tax" class="text-red"><i class="fa fa-plus-square-o text-red"></i>
         <b>@lang('account.net_profit_before_tax')</b>
        </a>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($first_net_profit_profit,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
       <span class="text-blue"><b>{{@number_format($second_net_profit_profit,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($third_net_profit_profit,2)}}</b></span>
      </div>
  </div>
</div>

<div class="">
  @php
  $first_tax_total = 0;
  $second_tax_total = 0;
  $third_tax_total = 0;
  @endphp
  <div class="box-header with-border">
      <div class="col-md-6 p-5">
        <a data-toggle="collapse" data-parent="#accordion" href="#tax_of_sales" class="text-black"><i class="fa fa-plus-square-o text-red"></i>
         <b>@lang('account.taxes')</b>
        </a>
      </div>
      @foreach ($tax_details as $key => $tax_detail)
      @php
      $first_tax_total += $tax_detail['first'];
      $second_tax_total += $tax_detail['second'];
      $third_tax_total += $tax_detail['third'];
      @endphp
      @endforeach
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($first_tax_total,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
       <span class="text-blue"><b>{{@number_format($second_tax_total,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($third_tax_total,2)}}</b></span>
      </div>
  </div>
  <div id="tax_of_sales" class="panel-collapse collapse">
    <div class="box-body">
        @foreach ($tax_details as $key => $tax_detail)
        <div class="col-md-6 p-5">
          {{$key}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($tax_detail['first'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($tax_detail['second'],2)}}
        </div>
        <div class="col-md-2 p-5">
          {{@number_format($tax_detail['third'],2)}}
        </div>
        @endforeach
    </div>
  </div>
</div>

<div class="">
  @php
  $first_net_profit_after_tax = $first_net_profit_profit - $first_tax_total;
  $second_net_profit_after_tax = $second_net_profit_profit - $second_tax_total;
  $third_net_profit_after_tax = $third_net_profit_profit - $third_tax_total;
  @endphp
  <div class="box-header with-border">
      <div class="col-md-6 p-5">
        <a data-toggle="collapse" data-parent="#net_profit_after_tax" href="#net_profit_after_tax" class="text-red"><i class="fa fa-plus-square-o text-red"></i>
         <b>@lang('account.net_profit_after_tax')</b>
        </a>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($first_net_profit_after_tax,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
       <span class="text-blue"><b>{{@number_format($second_net_profit_after_tax,2)}}</b></span>
      </div>
      <div class="col-md-2 p-5">
        <span class="text-blue"><b>{{@number_format($third_net_profit_after_tax,2)}}</b></span>
      </div>
  </div>
</div> --}}

@else
<div class="col-md-12 text-center" style="color: {{App\System::getProperty('not_enalbed_module_user_color')}}; font-size: {{App\System::getProperty('not_enalbed_module_user_font_size')}}px;">
    {{App\System::getProperty('not_enalbed_module_user_message')}}
</div>
@endif