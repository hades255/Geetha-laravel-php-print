<div class="modal-dialog" role="document">
  <div class="modal-content">

      {!! Form::open(['url' => action('StoreController@update', $store->id), 'method' => 'put', 'id' => 'store_add_form' ]) !!}

      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">@lang( 'store.edit_store' )</h4>
      </div>

      <div class="modal-body">
          <div class="row">
              <div class="form-group col-sm-12">
                  {!! Form::label('location_id', __( 'store.location' ) . ':*') !!}
                  <select class="form-control select2" name="location_id" id="location_id" required>
                      @foreach($business_locations as $key => $value)
                      <option value="{{ $key }}" @if($store->location_id == $key) selected @endif>{{ $value }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group col-sm-12">
                  {!! Form::label('name', __( 'store.name' ) . ':*') !!}
                  {!! Form::text('name', $store->name, ['class' => 'form-control', 'required', 'placeholder' => __(
                  'store.name' )]); !!}
              </div>

              <div class="form-group col-sm-12">
                  {!! Form::label('contact_number', __( 'store.contact_number' ) . ':*') !!}
                  {!! Form::text('contact_number', $store->contact_number, ['class' => 'form-control', 'placeholder' => __(
                  'store.contact_number' ), 'required']); !!}
              </div>
              <div class="form-group col-sm-12">
                  {!! Form::label('address', __( 'store.address' ) . ':*') !!}
                  {!! Form::textarea('address', $store->address, ['class' => 'form-control', 'placeholder' => __(
                  'store.address' ), 'rows' => 3, 'required']); !!}
              </div>

              <div class="col-md-12">
                  <div class="checkbox">
                    <label>
                      {!! Form::checkbox('status', 1, $store->status, 
                      [ 'class' => 'input-icheck']); !!} {{ __( 'store.active' ) }}
                    </label>
                  </div>
                </div>
          </div>

      </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
      </div>

      {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->