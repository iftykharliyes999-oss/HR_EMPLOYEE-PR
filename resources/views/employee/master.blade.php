<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon"
href="{{ asset('assets/images/favicon-32x32.png') }}">

<link href="{{ asset('assets/css/bootstrap.min.css') }}"
rel="stylesheet">

<link href="{{ asset('assets/css/bootstrap-extended.css') }}"
rel="stylesheet">

<link href="{{ asset('assets/css/app.css') }}"
rel="stylesheet">

<link href="{{ asset('assets/css/icons.css') }}"
rel="stylesheet">

<link href="{{ asset('assets/css/custom-dashboard.css') }}"
rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

<title>Employee Dashboard</title>

</head>

<body class="bg-theme bg-theme2">

<div class="wrapper">

@include('employee.parts.header')

@include('employee.parts.navbar')

<div class="page-wrapper">

@yield('content')

</div>

@include('employee.parts.footer')

</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>

@stack('js')

</body>

</html>
