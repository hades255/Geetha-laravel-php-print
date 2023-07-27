 <div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle btn-xs"
                data-toggle="dropdown" aria-expanded="false">' .
            __("messages.actions") .
        <span class="caret"></span><span class="sr-only">Toggle Dropdown
                </span>
    </button>
    <ul class="dropdown-menu dropdown-menu-left" role="menu">
        {{$slot}}
    </ul>
</div>