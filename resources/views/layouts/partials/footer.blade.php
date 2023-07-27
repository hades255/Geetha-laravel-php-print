@php
    $footersettings = DB::table('system')->where('key', 'app_footer')->select('value')->first();
@endphp

<!-- Main Footer -->
  <footer class="main-footer no-print">
    
    <small>
    	{{ $footersettings->value ?? "" }}
    </small>
    
</footer>