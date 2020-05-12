<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Kreasi Bangsa</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/fontawesome/css/all.min.css')}}">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/jqvmap/dist/jqvmap.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/weather-icon/css/weather-icons.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/summernote/summernote-bs4.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/datatables/datatables.min.css')}}">
	<link rel="stylesheet"
		href="{{ URL::asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet"
		href="{{ URL::asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
	<link rel="stylesheet"
		href="{{ URL::asset('assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/select2/dist/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/jquery-selectric/selectric.css')}}">
	<link rel="stylesheet"
		href="{{ URL::asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/chocolat/dist/css/chocolat.css')}}">


	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/components.css')}}">

</head>

<body>
	@php
	$full_name = Auth::user()->name;
	$name = explode(' ',$full_name);
	$acronym = "";

	foreach ($name as $a) {
	$acronym .= strtoupper($a[0]);
	}
	@endphp

	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			@include('back.layouts.navbar')

			@include('back.layouts.sidebar')

			@yield('content')

			@include('back.layouts.footer')
		</div>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ URL::asset('assets/modules/jquery.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/popper.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/tooltip.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/moment.min.js')}}"></script>
	<script src="{{ URL::asset('assets/js/stisla.js')}}"></script>

	<!-- JS Libraies -->
	<script src="{{ URL::asset('assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/chart.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/summernote/summernote-bs4.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/datatables/datatables.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}">
	</script>
	<script src="{{ URL::asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/cleave-js/dist/cleave.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/cleave-js/dist/addons/cleave-phone.us.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/select2/dist/js/select2.full.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>
	<script src="{{ URL::asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

	<!-- Page Specific JS File -->
	<script src="{{ URL::asset('assets/js/page/index-0.js')}}"></script>
	<script src="{{ URL::asset('assets/js/page/modules-datatables.js')}}"></script>
	<script src="{{ URL::asset('assets/js/page/forms-advanced-forms.js')}}"></script>

	<!-- Template JS File -->
	<script src="{{ URL::asset('assets/js/scripts.js')}}"></script>
	<script src="{{ URL::asset('assets/js/custom.js')}}"></script>
</body>

</html>