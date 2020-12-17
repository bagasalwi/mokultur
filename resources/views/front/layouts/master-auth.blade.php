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
	<title>Kreasibangsa - @yield('meta_title', 'Home')</title>

	@include('front.layouts.css-extension')

	@yield('css')
</head>

<body class="layout-3 @yield('bg-color', 'bg-light')">
	<div id="app">		
		@yield('content')
	</div>

	@include('front.layouts.script-extension')

	@yield('script')
	@stack('script')
</body>

</html>