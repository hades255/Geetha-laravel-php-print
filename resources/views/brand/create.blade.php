<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('BrandController@store'), 'method' => 'post', 'id' => $quick_add ? 'quick_add_brand_form' : 'brand_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'brand.add_brand' )</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('name', __( 'brand.brand_name' ) . ':*') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'brand.brand_name' ) ]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('description', __( 'brand.short_description' ) . ':') !!}
          {!! Form::text('description', null, ['class' => 'form-control','placeholder' => __( 'brand.short_description' )]); !!}
      </div>

        
          <div class="form-group">
             <label>
                {!!Form::checkbox('use_for_repair', 1, false, ['class' => 'input-icheck']) !!}
                {{ __( 'repair::lang.use_for_repair' )}}
            </label>
            @show_tooltip(__('repair::lang.use_for_repair_help_text'))
          </div>
        
         <div class="form-group">
             <label>
                {!!Form::checkbox('is_auto_repair', 1, false, ['class' => 'input-icheck']) !!}
                Use for Auto Repair?
            </label>
            @show_tooltip("If checked, brand will be displayed in dropdown used on <code>auto repair module</code>")
          </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->