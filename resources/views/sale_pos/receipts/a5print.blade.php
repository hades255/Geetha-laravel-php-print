

@php
$font_size = $receipt_details->font_size;
$h_font_size = $receipt_details->header_font_size;
$f_font_size = $receipt_details->footer_font_size;
$b_font_size = $receipt_details->business_name_font_size;
$i_font_size = $receipt_details->invoice_heading_font_size;
$footer_top_margin = $receipt_details->footer_top_margin;
$admin_invoice_footer = $receipt_details->admin_invoice_footer;
$logo_height = $receipt_details->logo_height;
$logo_width = $receipt_details->logo_width;
$logo_margin_top = $receipt_details->logo_margin_top;
$logo_margin_bottom = $receipt_details->logo_margin_bottom;
$header_align = $receipt_details->header_align;
$contact_details = $receipt_details->contact_details;
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">

<style>
.header-section {
  line-height: 20px !important;
}

@media print {
  @page {
      size: 11in 8.5in;
      margin: 2%;
    }

  .header-section {
    line-height: 20px !important;
    font-size : {{$i_font_size}}px !important;
  }

  .row {
    page-break-inside: avoid;
  }

  body {
    margin: 0;
    padding: 20;
  }
  
  
  
  .header1{
      text-transform : capitalize !important;
      /*font-size: 16px;*/
  }
  .header2{
      /*font-size: 13px;*/
  }
  .invoice-box{
      border: 1px solid #000000;
      padding: 5px !important;
      margin: 5px;
      font-weight: bold;
      font-size: {{$i_font_size}}px;
  }
  
  .logo-tag{
      border: 1px solid #000000;
      padding: 5px !important;
      margin: 5px;
      font-weight: bold;
      width: 100% !important;
      font-size: {{ceil(0.6*$h_font_size)}}px;
  }
  
  .separator{
      border-color: #000000;
  }
  
  .tr-head{
      border-color: #000000;
  }
  .business-name{
      font-size: {{$b_font_size}}px !important;
      font-weight: bold;
      text-transform : capitalize !important;
  }
  .logo{
      font-size: {{$h_font_size}}px !important;
      font-weight: bold;
  }
  
  .business-address{
      font-size: {{$i_font_size}}px;
  }
  
  .business-phone{
      font-size: {{$i_font_size}}px;
  }
  
}
</style>

<!-- Your existing HTML content here -->


<!-- Your existing HTML content here -->

<div class="a5size" style="width: 100% !mportant;">
    <div class="row">
        <div class="col-xs-4 text-center">
            
                @if(!empty($receipt_details->sub_heading_line1))
                    <span class="logo"><i>
            			{{ strtoupper($receipt_details->sub_heading_line1) }}
            		</i></span><br>
    			@endif
            
            
                @if(!empty($receipt_details->sub_heading_line2))
                    <h5 class="logo-tag">
            			{{ strtoupper($receipt_details->sub_heading_line2) }}
            		</h5>
    			@endif
            
        </div>
        <div class="col-xs-8">
            <div class="col-xs-12">
                
                    @if(!empty($receipt_details->display_name))
                        <span class="business-name">
                			{{strtoupper($receipt_details->display_name)}}
                		</span><br>
        			@endif
    			
                
                    @if(!empty($receipt_details->address))
                        <span class="business-address">
                            {!! $receipt_details->address !!}
                        </span>
                    @endif
                
            </div>
            @if(!empty($receipt_details->contact))
            <div class="col-xs-4 business-phone">
                <span>
                        {{ $receipt_details->contact }}
                    <br>
                </span>
            </div>
            @endif
            <div class="col-xs-8 text-right">
                <span class="invoice-box" style="width: 100% !important;">{{$receipt_details->invoice_no}}<span class="spacer" style="padding-left: 50px !important"></span>{!! strtoupper($receipt_details->invoice_no_prefix) !!}</span>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
    	
    	<div class="col-xs-12 header-section">
    			<div class="col-xs-6 text-left">
    			    @if(!empty($receipt_details->customer_name))
        			    <small><span class="">
                				{{ strtoupper($receipt_details->customer_name) }}
        			    </span></small>
    			    @endif
    			    
    			    @if(!empty($receipt_details->customer_info))
            			<small><span class="">
            			    @php logger($receipt_details->customer_info) @endphp
                				{!! $receipt_details->customer_info !!}
            			</span></small><br>
        			@endif
    			</div>
    			<div class="col-xs-6 text-left">
    			    <div class="pull-right">
    			        <small><span class=""><b>{{strtoupper($receipt_details->date_label)}}</b> {{$receipt_details->invoice_date}}</span><br>
    			        @if($receipt_details->reprint > 1)
                			<span class="">INVOICE REPRINT COPY - {{ $receipt_details->reprint-1 }}</span><br></small>
            			@endif
    			    </div>
    			    
    			</div>
    	</div>
    </div>

<div class="row">
	<div class="col-xs-12">
		<table class="table table-responsive">
			<thead>
				<tr>
					<th style="border-color: #000000;border-width: 1px;font-size: {{$font_size}}px !important;">Item Code</th>
					<th style="border-color: #000000;border-width: 1px;font-size: {{$font_size}}px !important;">{{$receipt_details->table_product_label}}</th>
					<th style="border-color: #000000;border-width: 1px;font-size: {{$font_size}}px !important;">{{$receipt_details->table_qty_label}}</th>
					<th style="border-color: #000000;border-width: 1px;font-size: {{$font_size}}px !important;">{{$receipt_details->table_unit_price_label}}</th>
					<th style="border-color: #000000;border-width: 1px;font-size: {{$font_size}}px !important;">Discount</th>
					<th style="border-color: #000000;border-width: 1px;font-size: {{$font_size}}px !important;">{{$receipt_details->table_subtotal_label}}</th>
				</tr>
			</thead>
			<tbody>
			    @forelse($receipt_details->lines as $line)
			    @php logger($line) @endphp
				<tr>
				    <td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">{{$line['sub_sku']}}</td>
					<td style="word-break: break-all; font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">
						{{strtoupper($line['name'])}} 
					</td>
					<td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">{{$line['quantity']}} {{$line['units']}} </td>
					<td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">{{$line['unit_price_before_discount']}}</td>
					<td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">{{$line['line_discount'] * $line['quantity']}} {{$line['line_discount_percentage']}}
					</td>
					<td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">{{$line['line_total']}}</td>
				</tr>
    				@if(!empty($line['modifiers']))
    				@foreach($line['modifiers'] as $modifier)
    				<tr>
    					<td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">
    						{{$modifier['name']}} {{$modifier['variation']}}
    						@if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif
    						@if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
    						@if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif
    					</td>
    					<td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">{{$modifier['quantity']}} {{strtoupper($modifier['units'])}} </td>
    					<td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">{{$modifier['unit_price_before_discount']}}</td>
    					<td style="font-size: {{$font_size}}px !important;padding-top: 0px !important;padding-bottom: 0px !important">{{$modifier['line_total']}}</td>
    				</tr>
    				@endforeach
    				@endif
    				@empty
    				<tr>
    					<td colspan="6">&nbsp;</td>
    				</tr>
    				@endforelse
    				
			</tbody>
		
		</table>
		<hr class="separator">
		<div class="row" style="font-size: {{$font_size}}px !important;">
		    
		    <div class="col-xs-6">
		        <div class="col-xs-6">
		            {!! $receipt_details->total_paid_label !!}
    		        
    		    </div>
    		    
    		    <div class="col-xs-6 text-right">
    		        @if(!empty($receipt_details->total_paid))
    		        <b>{{$receipt_details->total_paid}}</b>
    		        @else
    		        <b>0.00</b>
    		        @endif
    		    </div>
    		    
		    </div>
		    
		    <div class="col-xs-6">
		        <div class="col-xs-6">
		            {!! $receipt_details->total_label !!}
    		    </div>
    		    <div class="col-xs-6 text-right">
    		        <b>{{$receipt_details->total}}</b>
    		    </div>
		    </div>
		    
		</div>
		
		<div class="row" style="font-size: {{$font_size}}px !important;">
		    
		    <div class="col-xs-6">
		        <div class="col-xs-6">
		            {!! $receipt_details->total_due_label !!}
    		    </div>
    		    
    		    <div class="col-xs-6 text-right">
    		        @if(!empty($receipt_details->total_due))
    		        <b>{{$receipt_details->total_due}}</b>
    		        @else
    		        <b>0.00</b>
    		        @endif
    		    </div>
    		    
		    </div>
		    
		    <div class="col-xs-6">
		        <div class="col-xs-6">
		            {!! $receipt_details->discount_label !!}
    		    </div>
    		    
    		    <div class="col-xs-6 text-right">
    		        @if( !empty($receipt_details->discount) )
    		        <b>(-) {{$receipt_details->discount}}</b>
    		        @else
    		        <b>0.00</b>
    		        @endif
    		    </div>
    		     
		    </div>
		    
		</div>
		
		<div class="row" style="font-size: {{$font_size}}px !important;">
		    
		    @if(!empty($receipt_details->all_due))
		    <div class="col-xs-6">
		        <div class="col-xs-6">
		            {!! $receipt_details->all_bal_label !!}
    		    </div>
    		    
    		    <div class="col-xs-6 text-right">
    		        @if(!empty($receipt_details->all_due))
    		        <b>{{$receipt_details->all_due}}</b>
    		        @else
    		        <b>0.00</b>
    		        @endif
    		    </div>
		    </div>
		    @endif
		    
		    <div class="col-xs-6"></div>
			
		</div>
		
		
	</div>
</div>

<br>

<div class="row">
	<div class="col-xs-12 text-center">
		<div class="col-xs-3 text-center">
		    <hr class="separator">
		    <h5>Customer signature</h5>
		</div>
		
		<div class="col-xs-3 text-center">
		    <hr class="separator">
		    <h5>Checked By</h5>
		</div>
		
		<div class="col-xs-3 text-center">
		    <hr class="separator">
		    <h5>Checked By</h5>
		</div>
		
		<div class="col-xs-3 text-center">
		    <hr class="separator">
		    <h5>Checked By</h5>
		</div>
	</div>
</div>

<div class="row" style="font-size: {{$f_font_size}}px !important;">
	<div class="col-xs-12 text-center">
		<h5>
		    @if(!empty($receipt_details->footer_text))
                {!! $receipt_details->footer_text !!}
            @endif
        </h5>
	</div>
</div>


@if(!empty($admin_invoice_footer))
<div class="row">
	<div class="col-xs-12 text-center">
		<p class="centered"
			style="font-size: {{$f_font_size}}px !important; margin-top: @if(!empty($footer_top_margin)) {{$footer_top_margin }}px; @else 10px; @endif">
			{!! $admin_invoice_footer !!}
		</p>
	</div>
</div>
@endif
</div>
