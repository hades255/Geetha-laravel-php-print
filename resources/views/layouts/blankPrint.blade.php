
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- google adsense -->
    <script data-ad-client="ca-pub-1123727429633739" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <title>@yield('title') - {{ config('app.name', 'POS') }}</title>

    @include('layouts.partials.css')

    <!-- Jquery Steps -->
    <link rel="stylesheet" href="{{ asset('plugins/jquery.steps/jquery.steps.css?v=' . $asset_v) }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/iCheck/square/blue.css?v='.$asset_v) }}">


    <style>

    @media print {

		.no-print,
		.no-print * {
			display: none !important;
		}
	}
    </style>
</head>


<body class="hold-transition">
    @yield('content')
    <script src="{{ asset('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js?v=' . $asset_v) }}"></script>
    @yield('javascript')
</body>

</html>