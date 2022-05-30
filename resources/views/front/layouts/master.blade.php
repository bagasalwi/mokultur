<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="keywords" content="Mokultur,Mo,Kultur, @yield('meta_keyword')" />
	<meta name="description" content="@yield('meta_desc', ' Mokultur adalah ruang terbuka untuk kalian yang mempunyai tingkat kulturasi tinggi, disini kalian bisa berbagi macam-macam tulisan random mulai dari Geeks, Pop Culture, Film, Teknologi dan lainnya.')" />
	<meta itemprop="name" content="@yield('meta_title', '')Mokultur">
	<meta itemprop="description" content="@yield('meta_desc', ' Mokultur adalah ruang terbuka untuk kalian yang mempunyai tingkat kulturasi tinggi, disini kalian bisa berbagi macam-macam tulisan random mulai dari Geeks, Pop Culture, Film, Teknologi dan lainnya.')">
	<meta itemprop="image" content="@yield('meta_img', asset('gambar/logo/logo.png'))">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@yield('meta-tags')

	<link rel="icon" href="{{ asset('gambar/logo/icon.svg') }}">
	<title>Mokultur - @yield('meta_title', 'Home')</title>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167875262-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-167875262-1');
	</script>


	@include('front.layouts.css-extension')

	@yield('css')
	@stack('css')
</head>

<body class="layout-3 @yield('bg-color', 'bg-light')">
	
	<div id="app">
		@include('front.layouts.navbar')

		@yield('content')

		@include('front.layouts.footer')
	</div>

	@include('front.layouts.script-extension')
	@include('front.layouts.modal')

	@yield('script')
	@stack('script')

	<script src="https://unpkg.com/starback@2.0.1/dist/starback.js"></script>
	
	<script>
	
	let wrapper = document.querySelector('.starback')

	const starback = new Starback("#canvas", {
		width: wrapper.clientWidth,
		height: wrapper.clientHeight,
		type: 'dot',
		quantity: 100,
		starSize: [1,3],
		direction: 20,
		starColor: '#ffffff',
		randomOpacity: [0.3, 0.7],
		backgroundColor: 'transparent'
	})


	</script>

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

		lottie.loadAnimation({
			container: document.getElementById('animejson'),
			renderer: 'svg',
			loop: true,
			autoplay: true,
			path: '{{ asset('anijson/anime-1.json') }}'
		});

	</script>
</body>

</html>