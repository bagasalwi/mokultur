@extends('front.layouts.master')

@section('content')
	{{-- <section class="section"> --}}
		<div class="container my-4">
			<h2>Admin Manager</h2>
			<ul class="nav nav-pills" id="myTab3" role="tablist">
				@foreach ($sidebar as $sb)
				<li class="nav-item mr-2">
					
					<a class="nav-link {{ url()->current() == url($sb->url) ? 'active' : '' }}" href="{{ url($sb->url) }}"><i class="{{ $sb->icon }}"></i> {{ $sb->name }}</a>
				</li>
				@endforeach
			</ul>
			<hr>
		</div>
	{{-- </section> --}}

	@yield('adminContent')

@endsection