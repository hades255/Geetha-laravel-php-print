@extends('layouts.app')
@section('title', 'Brands')

@section('content')


<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">@lang( 'brand.manage_your_brands' )</h4>
                <ul class="breadcrumbs pull-left" style="margin-top: 15px">
                    <li><a href="#">@lang( 'brand.brands' )</a></li>
                    <li><span>@lang( 'brand.manage_your_brands' )</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content main-content-inner">
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'brand.all_your_brands' )])
        @can('brand.create')
            @slot('tool')
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-primary btn-modal" 
                        data-href="{{action('BrandController@create')}}" 
                        data-container=".brands_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                </div>
            @endslot
        @endcan
        @can('brand.view')
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="brands_table">
                    <thead>
                        <tr>
                            <th>@lang( 'brand.brands' )</th>
                            <th>@lang( 'brand.note' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcan
    @endcomponent

    <div class="modal fade brands_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
