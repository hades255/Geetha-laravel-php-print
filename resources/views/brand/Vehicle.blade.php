<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('VehicleController@store'), 'method' => 'post']) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Add Vehicle</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
          {!! Form::label('name','Customer Name'. ':*') !!}
          <!-- {!! Form::select('Client_name',$data, ['class' => 'form-control', 'required', 'placeholder' => 'Enter Customer Name','id'=>'VehicleclientName']); !!} -->
          <select name="VehicleclientName" id="" class="form-control select2">
            <option value="">Select Customer Name</option>
            @foreach($data as $data)

            <option value="{{$data->id}}">{{$data->name}}</option>
            @endforeach
          </select>
      </div>

      <div class="form-group">
        {!! Form::label('vehicleName','Vehicle Number'. ':') !!}
          {!! Form::text('vehicleName', null, ['class' => 'form-control','placeholder' =>'Enter Vehicle Number']); !!}
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->