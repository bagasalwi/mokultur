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
                        <button type="button" data-toggle="modal" data-target="#articleType"
                            class="btn btn-dark px-4">Create New Post</button>
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
                    }else{
                        $status = 'null';
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
                <div class="empty-state" data-height="400">
                    <img width="150" src="{{ URL::asset('gambar/sketch/7.svg')}}">
                    <h2>Tidak ada Post</h2>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal center fade" id="articleType" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body m-4 p-0">
                <div class="card card-topic no-bd-radius">
                    <div class="card-body d-flex row">
                        <div class="col-2 align-self-center">
                            <img class="img-fluid" src="{{ asset('gambar/icon/article.png') }}" width="70" height="70" alt="">
                        </div>
                        <div class="col-10 align-self-center">
                            <h4 class="text-dark no-pm">Simple Article</h4>
                            <small class="text-secondary">Make an simple article about your stories, reviews, tutorials and more!</small>
                            <a class="stretched-link" href="{{ route('post.create', 'type=article') }}"></a>
                        </div>
                    </div>
                </div>
                <div class="card card-topic no-bd-radius">
                    <div class="card-body d-flex row">
                        <div class="col-2 align-self-center">
                            <img class="img-fluid" src="{{ asset('gambar/icon/gallery.png') }}" width="70" height="70" alt="">
                        </div>
                        <div class="col-10 align-self-center">
                            <h4 class="text-dark no-pm">Slideshow Article</h4>
                            <small class="text-secondary">Make an Slideshow photo article about your stories, reviews, tutorials and more!</small>
                            <a class="stretched-link" href="{{ route('post.create', 'type=photo') }}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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