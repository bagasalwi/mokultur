@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="d-flex flex-row">
                    <div class="mr-auto">
                        <h2 class="text-dark">My Post</h2>
                    </div>
                    <div class="ml-auto">
                        <a href="{{ route('post.create') }}" class="btn btn-dark px-4">Create New Post</a>
                    </div>
                </div>
                @if ($post)
                <div id="posts" class="my-4">
                    @foreach ($post as $item)

                    @php
                    if($item->status == 'P'){
                    $status = 'Published';
                    $s_color = 'success';
                    }else if($item->status == 'D'){
                    $status = 'Draft';
                    $s_color = 'danger';
                    }
                    @endphp

                    <div class="card border-0">
                        <div class="d-flex flex-row">
                            <h6><a class="text-dark"
                                    href="{{ route('post.detail', $item->slug) }}">{{ $item->title }}</a></h6>
                        </div>
                        <div class="d-flex flex-row">
                            <div>
                                <p><small class="text-secondary">Created
                                        {{ $item->created_at->diffForHumans() }}</small> <span
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
                {!! $post->render() !!}
                @else
                <div class="text-center">
                    <h6 class="text-secondary font-weight-normal">No Post </h6>
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

<script>
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
</script>
@endsection