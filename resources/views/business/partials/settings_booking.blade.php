<div class="pos-tab-content">
    <div class="row">
        {{-- booking --}}
        @foreach($modules as $k => $v)
        @if($k == 'booking')
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    {!! Form::checkbox('enabled_modules[]', $k,  in_array($k, $enabled_modules) , 
                    ['class' => 'input-icheck']); !!} {{$v['name']}}
                  </label>
                  @if(!empty($v['tooltip'])) @show_tooltip($v['tooltip']) @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
   </div>
</div>