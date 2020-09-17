<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="keywords" content="kreasi bangsa, kreasi, bangsa, kreasibangsa" />

	<meta name="description"
		content="Kreasi bangsa merupakan sarana untuk mengenalkan kreasi - kreasi anak bangsa, mulai dari sketch, UI hingga ilustrasi." />
	<meta itemprop="name" content="Kreasibangsa">
	<meta itemprop="description"
		content="Kreasi bangsa merupakan sarana untuk mengenalkan kreasi - kreasi anak bangsa, mulai dari sketch, UI hingga ilustrasi.">
	<meta itemprop="image" content="https://kreasibangsa.com/gambar/logo.png">

	<link rel="icon" href="{{ URL::asset('gambar/Logo.svg') }}">
	<title>Kreasibangsa</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/fontawesome/css/all.min.css')}}">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/summernote/summernote-bs4.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/datatables/datatables.min.css')}}">
	<link rel="stylesheet"
		href="{{ URL::asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet"
		href="{{ URL::asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
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

	<link href="{{ URL::asset('assets/modules/aos/aos.css')}}" rel="stylesheet">

	{{-- font --}}
	<link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

	<style type="text/css">
		.smart-scroll {
			position: fixed;
			top: 0;
			right: 0;
			left: 0;
			z-index: 1030;
		}

		.scrolled-down {
			transform: translateY(-100%);
			transition: all 0.3s ease-in-out;
		}

		.scrolled-up {
			transform: translateY(0);
			transition: all 0.3s ease-in-out;
		}

		.dropdown-toggle::after {
			display: none;
		}

		.text-decoration-none {
			text-decoration: none !important;
		}

		/* Font Awesome Icons have variable width. Added fixed width to fix that.*/
		.icon-width {
			width: 2rem;
		}
	</style>
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

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167875262-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-167875262-1');

	// if ($(window).width() > 992) {
	// 	$(window).scroll(function(){  
	// 		if ($(this).scrollTop() > 40) {
	// 			$('#navbar_top').addClass("fixed-top");
	// 			$('body').css('padding-top', $('.navbar').outerHeight() + 'px');
	// 		}else{
	// 			$('#navbar_top').removeClass("fixed-top");
	// 			$('body').css('padding-top', '0');
	// 		}   
	// 	});
	// }

	$(document).ready(function () {
		if ($(window).width() > 991){
			$('.navbar-light .d-menu').hover(function () {
        		$(this).find('.sm-menu').first().stop(true, true).slideDown(150);
			}, function () {
        		$(this).find('.sm-menu').first().stop(true, true).delay(120).slideUp(100);
    			});
    		}
		});

	// add padding top to show content behind navbar
	$('body').css('padding-top', $('.navbar').outerHeight() + 'px')

	// detect scroll top or down
	if ($('.smart-scroll').length > 0) { // check if element exists
		var last_scroll_top = 0;
		$(window).on('scroll', function() {
			scroll_top = $(this).scrollTop();
			if(scroll_top < last_scroll_top) {
				$('.smart-scroll').removeClass('scrolled-down').addClass('scrolled-up');
			}
			else {
				$('.smart-scroll').removeClass('scrolled-up').addClass('scrolled-down');
			}
			last_scroll_top = scroll_top;
		});
	}
	</script>
</body>

</html>