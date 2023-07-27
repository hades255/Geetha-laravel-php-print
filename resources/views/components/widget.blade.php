<div class="box {{$class ?? 'box-solid'}}" @if(!empty($id)) id="{{$id}}" @endif style="font-size: 12px !important">
    @if(empty($header))
        @if(!empty($title) || !empty($tool))
        <div class="box-header">
            {!!$icon ?? '' !!}
            <h4 class="box-title text-center">{{ $title ?? '' }}</h4><br>
            @if(isset($date))
                <span id="report_date_range" style="margin-left:30%;">
                   Date Range: {{ date('m/01/Y') }} ~ {{ date('m/t/Y') }}
                </span>
            @endif
            {{$tool ?? ''}}
        </div>
        @endif
    @else
        <div class="box-header">
            {!! $header !!}
        </div>
    @endif

    <div class="box-body">
        {{$slot}}
    </div>
    <!-- /.box-body -->
</div>