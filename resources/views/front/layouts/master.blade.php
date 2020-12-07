<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="keywords" content="kreasi bangsa, kreasibangsa, @yield('meta_keyword')" />
	<meta name="description" content="@yield('meta_desc', 'Kreasi bangsa merupakan sarana untuk mengenalkan kreasi - kreasi anak bangsa, mulai dari sketch, UI hingga ilustrasi.')" />
	<meta itemprop="name" content="@yield('meta_title', '')Kreasibangsa">
	<meta itemprop="description" content="@yield('meta_desc', 'Kreasi bangsa merupakan sarana untuk mengenalkan kreasi - kreasi anak bangsa, mulai dari sketch, UI hingga ilustrasi.')">
	<meta itemprop="image" content="https://kreasibangsa.com/gambar/logo.png">

	@yield('meta-tags')

	<link rel="icon" href="{{ asset('gambar/logo/logo-mini.svg') }}">
	<title>@yield('meta_title', 'Kreasibangsa')</title>

	@include('front.layouts.css-extension')

	@yield('css')
</head>

<body class="layout-3 bg-light">
	<div id="app">
		@include('front.layouts.navbar')

		@yield('content')
	</div>

	@include('front.layouts.script-extension')

	@yield('script')
	@stack('script')

	<script>
		lottie.loadAnimation({
			container: document.getElementById('anijson'),
			renderer: 'svg',
			loop: true,
			autoplay: true,
			path: '{{ asset('anijson/hero5.json') }}'
		});

		lottie.loadAnimation({
			container: document.getElementById('covid19'),
			renderer: 'svg',
			loop: true,
			autoplay: true,
			path: '{{ asset('anijson/corona.json') }}'
		});

		lottie.loadAnimation({
			container: document.getElementById('instagram'),
			renderer: 'svg',
			loop: true,
			autoplay: true,
			path: '{{ asset('anijson/social.json') }}'
		});

		// Maximum offset for image
		var maxDeltaX = 20,
			maxDeltaY = 20;

		$(document).on('mousemove', function(e) {

			// Get viewport dimensions
			var viewportWidth = document.documentElement.clientWidth,
				viewportHeight = document.documentElement.clientHeight;

			var mouseX = e.pageX / viewportWidth * 2 - 1,
			mouseY = e.pageY / viewportHeight * 2 - 1;

			// Calculate how much to transform the image
			var translateX = mouseX * maxDeltaX,
				translateY = mouseY * maxDeltaY;
			$('.animated').css('transform', 'translate('+translateX+'px, '+translateY+'px)');
		});
	</script>
</body>

</html>