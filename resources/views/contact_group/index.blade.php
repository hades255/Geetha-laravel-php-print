@extends('layouts.app')
@section('title', __( 'lang_v1.contact_groups' ))

@section('content')

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h5 class="page-title pull-left">Contact Groups</h5>
                <ul class="breadcrumbs pull-left" style="margin-top: 15px">
                    <li><a href="#">Contact</a></li>
                    <li><span>Contact Groups</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content main-content-inner">

    <div class="settlement_tabs">
        <ul class="nav nav-tabs">
            @if($contact_customer)
            <li class="active">
                <a href="#customer" data-toggle="tab">
                    <i class="fa fa-address-book"></i> <strong>@lang('lang_v1.customer')</strong>
                </a>
            </li>
            @endif
            @if($contact_supplier)
            <li class=" @if(!$contact_customer) active @endif">
                <a href="#supplier" data-toggle="tab">
                    <i class="fa fa-address-book"></i> <strong>
                        @lang('lang_v1.supplier') </strong>
                </a>
            </li>
            @endif
        </ul>
        <div class="tab-content">
            @if($contact_customer)
            <div class="tab-pane active" id="customer">
                <div class="row">
                    <div class="col-md-12">
                        @include('contact_group.partials.customer_group')
                    </div>
                </div>
            </div>
            @endif
            @if($contact_supplier)
            <div class="tab-pane @if(!$contact_customer) active @endif" id="supplier">
                <div class="row">
                    <div class="col-md-12">
                        @include('contact_group.partials.supplier_group')
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    <div class="modal fade contact_groups_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
<style>
  .nav-tabs-custom>.nav-tabs>li.active a{
    color:#3c8dbc;
  }
  .nav-tabs-custom>.nav-tabs>li.active a:hover{
    color:#3c8dbc;
  }
</style>
@endsection

@section('javascript')
<script>

    $('#add_group_btn').click(function(){
  		$('.contact_groups_modal').modal({
    		backdrop: 'static',
    		keyboard: false
	    });

    });

</script>

<script type="text/javascript">
    $(document).on('change', '#price_calculation_type', function () {
        var price_calculation_type = $(this).val();

        if (price_calculation_type == 'percentage') {
            $('.percentage-field').removeClass('hide');
            $('.selling_price_group-field').addClass('hide');
        } else {
            $('.percentage-field').addClass('hide');
            $('.selling_price_group-field').removeClass('hide');
        }
    })
</script>
@endsection