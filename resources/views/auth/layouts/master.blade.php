<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<link rel="icon" href="{{ URL::asset('gambar/Logo.svg') }}">
	<title>Kreasibangsa</title>

    <!-- General CSS Files -->
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/fontawesome/css/all.min.css')}}">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap-social/bootstrap-social.css')}}">

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/components.css')}}">

</head>

<body class="layout-3"
    style="background: url(gambar/bg1.png) no-repeat center center fixed;background-size:fill;background-position:center center;overflow:hidden;">
    <div id="app">
        @yield('content')
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

	<!-- Page Specific JS File -->
	
	<!-- Template JS File -->
	<script src="{{ URL::asset('assets/js/scripts.js')}}"></script>
	<script src="{{ URL::asset('assets/js/custom.js')}}"></script>

	<!-- Page Specific JS File -->

    @yield('script')
</body>

</html>