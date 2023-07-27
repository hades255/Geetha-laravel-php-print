@extends('layouts.app')
@section('title', __('lang_v1.warranties'))

@section('content')



<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">@lang('lang_v1.warranties')</h4>
                <ul class="breadcrumbs pull-left" style="margin-top: 15px">
                    <li><a href="#">Products</a></li>
                    <li><span>@lang('lang_v1.warranties')</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content main-content-inner">
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'lang_v1.all_warranties' )])
        @slot('tool')
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-modal" 
                    data-href="{{action('WarrantyController@create')}}" 
                    data-container=".view_modal">
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
            </div>
        @endslot
        <table class="table table-bordered table-striped" id="warranty_table">
            <thead>
                <tr>
                    <th>@lang( 'lang_v1.name' )</th>
                    <th>@lang( 'lang_v1.description' )</th>
                    <th>@lang( 'repair::lang.duration' )</th>
                    <th class="notexport">@lang( 'messages.action' )</th>
                </tr>
            </thead>
        </table>
    @endcomponent

</section>
<!-- /.content -->
@stop

@section('javascript')
<script src="{{ asset('plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready( function(){
        //Status table
        var warranty_table = $('#warranty_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{action('WarrantyController@index')}}",
                columnDefs: [ {
                    "targets": 3,
                    "orderable": false,
                    "searchable": false
                } ],
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'duration', name: 'duration' },
                    { data: 'action', name: 'action' },
                ],
                 @include('layouts.partials.datatable_export_button')
            });

        $(document).on('submit', 'form#warranty_form', function(e){
            e.preventDefault();
            $(this).find('button[type="submit"]').attr('disabled', true);
            var data = $(this).serialize();

            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success: function(result){
                    if(result.success == true){
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        warranty_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
@endsection
