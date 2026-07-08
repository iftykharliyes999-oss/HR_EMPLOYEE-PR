<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('')}}assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{asset('')}}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{asset('')}}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{asset('')}}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('')}}assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{asset('')}}assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('')}}assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('')}}assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="{{asset('')}}https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('')}}assets/css/app.css" rel="stylesheet">
	<link href="{{asset('')}}assets/css/icons.css" rel="stylesheet">

	<title>HRMS - Admin Dashboard</title>
</head>

<body class="bg-theme bg-theme2">
	<!--wrapper-->
	<div class="wrapper">
		<!--start header wrapper-->
<div class="header-wrapper">

    @include('admin.parts.header')

    @include('admin.parts.navbar')

</div>
<!--end header wrapper-->


<!--start page wrapper -->
<div class="page-wrapper">

    @yield('content')

</div>
<!--end page wrapper -->

		<!--Start Back To Top Button--> <a href="{{asset('')}}javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('admin.parts.footer')
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	@include('admin.parts.switcher')
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{asset('')}}assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{asset('')}}assets/js/jquery.min.js"></script>
	<script src="{{asset('')}}assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{asset('')}}assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{asset('')}}assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{asset('')}}assets/plugins/chartjs/chart.min.js"></script>
	<script src="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{asset('')}}assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="{{asset('')}}assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="{{asset('')}}assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="{{asset('')}}assets/plugins/jquery-knob/jquery.knob.js"></script>
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
	  <script src="{{asset('')}}assets/js/index.js"></script>
	<!--app JS-->
	<script src="{{asset('')}}assets/js/app.js"></script>
</body>

</html>
