@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-4 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Admin Manager</h1>
            </div>
        </div>
    </div>
</div>
	<section class="section">
		<div class="container">
			<div class="card card-body bd-radius-8">
				<ul class="nav nav-pills" id="myTab3" role="tablist">
					@foreach ($sidebar as $sb)
					<li class="nav-item mr-2">
						<a class="nav-link {{ url()->current() == url($sb->url) ? 'active' : '' }}" href="{{ url($sb->url) }}"><i class="{{ $sb->icon }}"></i> {{ $sb->name }}</a>
					</li>
					@endforeach
				</ul>
			</div>
			<hr>
		</div>
		
		@yield('adminContent')
		</section>

@endsection