@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-4 mb-0"
    style="padding-bottom: 80px; margin-bottom: -190px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold">Your Article & Reviews List!</h1>
                <p class="mb-3 text-white">
                    Create, Edit, Update Your Article & Reviews Easily. 
                </p>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="container mb-3">
        <div class="card card-body border-0 bd-radius-8 shadow">
            <div class="d-flex flex-row">
                <div class="mr-auto">
                    <ul class="nav nav-pills" id="post-bar" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('post') ? 'active' : '' }}" href="{{ route('post.index') }}">
                                My Article
                            </a>
                            <a class="nav-link {{ request()->is('review') ? 'active' : '' }}" href="{{ route('review.index') }}">
                                My Review
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ml-auto">
                    <a class="btn btn-primary px-4" href="{{ url($url_create) }}">Create New Review</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    @if ($review->isNotEmpty())
                    <div id="posts" class="my-4">
                        @foreach ($review as $item)
    
                        @php
                        if($item->status == 'P'){
                            $status = 'Published';
                            $s_color = 'success';
                        }else if($item->status == 'D'){
                            $status = 'Draft';
                            $s_color = 'danger';
                        }else{
                            $status = 'null';
                            $s_color = 'danger';
                        }
                        @endphp
    
                        <div class="card border-0">
                            <div class="d-flex flex-row">
                                <a class="text-dark" href="{{ route('review.detail',[$item->user->username,$item->slug]) }}">
                                    <h4>{{ $item->title }}</h4>
                                </a>
                            </div>
                            <div class="d-flex flex-row">
                                <div>
                                    <p>Created
                                            {{ $item->created_at->format('d M Y') }}<span
                                            class="badge badge-{{ $s_color }} mx-2">{{ $status }}</span></p>
                                </div>
                                <div class="ml-auto px-2">
                                    <a href="{{ $url_update }}/{{ $item->slug }}"
                                        class="btn btn-outline-dark btn-sm px-4">Edit</a>
                                    <button onclick="deleteReview({{ $item->id }})"
                                        class="btn btn-danger btn-sm px-2">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                    <div class="float-right">
                        {!! $review->render() !!}
                    </div>
                    @else
                    <div class="empty-state" data-height="400">
                        <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                        <h2>Tidak ada Post</h2>
                        <p class="lead">
                            Kamu belum mengupload Review saat ini
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
@if ($message = Session::get('success'))
<script>
    swal("Success!", "{{ $message }}");
</script>
@endif

<script>
    function deleteReview(id){       
        swal({
        title: "Are you sure?",
        text: "Are your sure want to delete this row data?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
            $.ajax({
            url: "{{ url('review/delete') }}" + "/" + id,
            success: function(){
                swal("Done!","It was succesfully deleted!","success");
                setInterval('window.location.reload()', 1000);
            },
            error: function(){
                swal("Error!", "", "Error");
            }});
        }
      });
    }
</script>
@endsection