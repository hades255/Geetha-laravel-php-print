<div class="row" style="margin-bottom: 5px !important;">
    
    <div id="accordion1" class="according @if(!empty($class)) {{$class}} @else @endif">
        <div class="card">
            <div class="card-header" style="cursor: pointer;">
                <a class="card-link" data-toggle="collapse" style="padding-top: 5px !important; padding-bottom: 5px !important" href="#accordion11">@if(!empty($icon)) {!! $icon !!} @else <i class="fa fa-filter" aria-hidden="true"></i> @endif {{$title ?? ''}} </a>
            </div>
            <div id="accordion11" class="collapse show" data-parent="#accordion1">
                <div class="card-body">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>