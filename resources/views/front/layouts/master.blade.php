<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Kreasibangsa</title>

	<!-- General CSS Files -->
	{{-- <link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap/css/bootstrap.css')}}"> --}}
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/components.css')}}">
	{{-- <link rel="stylesheet" href="{{ URL::asset('assets/css/all.min.css')}}"> --}}

	<link href="{{ URL::asset('assets/modules/aos/aos.css')}}" rel="stylesheet">

	{{-- font --}}
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

</head>

<body class="layout-3 bg-white">
	<div id="app">
		@include('front.layouts.navbar')

		@yield('content')

	</div>
	@include('front.layouts.footer')


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
	<script src="{{ URL::asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js')}}"></script>

	<!-- Page Specific JS File -->
	<script src="{{ URL::asset('assets/js/page/index-0.js')}}"></script>
	<script src="{{ URL::asset('assets/js/page/modules-datatables.js')}}"></script>
	<script src="{{ URL::asset('assets/js/page/forms-advanced-forms.js')}}"></script>
	<script src="{{ URL::asset('assets/js/page/modules-slider.js')}}"></script>

	<!-- Template JS File -->
	<script src="{{ URL::asset('assets/js/scripts.js')}}"></script>
	<script src="{{ URL::asset('assets/js/custom.js')}}"></script>
	<script src="{{ URL::asset('assets/js/all.min.js')}}"></script>

	<script src="{{ URL::asset('assets/modules/aos/aos.js')}}"></script>

	<script>
		AOS.init();
	</script>

	@yield('script')
</body>

</html>