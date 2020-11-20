@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="d-flex flex-row">
                    <div class="mr-auto">
                        <h2 class="text-dark">My Review</h2>
                    </div>
                    <div class="ml-auto">
                        <a class="btn btn-dark px-4" href="{{ url($url_create) }}">Create New Review</a>
                    </div>
                </div>
                <hr>
                @if ($review)
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
                            <a class="text-dark" href="{{ route('post.detail', $item->slug) }}">
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
                                <button onclick="deletePost({{ $item->id }})"
                                    class="btn btn-outline-danger btn-sm px-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
                {!! $review->render() !!}
                @else
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Post</h2>
                </div>
                @endif
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

{{-- <script>
    function deletePost(id){       
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
            url: "{{ url('post/delete') }}" + "/" + id,
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
</script> --}}
@endsection