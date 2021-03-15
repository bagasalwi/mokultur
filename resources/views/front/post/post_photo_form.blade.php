@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Post Content</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    Create your own Article? yes, Here!
                </p>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="container">
        <form action="{{ route('post.save-photo') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $fields->id }}">
            <input type="hidden" name="state" value="{{ $state }}">
            <input type="hidden" name="type" value="{{ $type }}">

            {{-- <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="mr-auto">
                        <h2 class="text-dark">Post Content</h2>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="row">
                        <div class="col-6 my-2">
                            <a href="{{ route('post.index') }}" class="btn btn-danger btn-block">Cancel</a>
    </div>
    <div class="col-6 my-2">
        <button type="submit" class="btn btn-dark btn-block">Submit</button>
    </div>
    </div>
    </div>
    </div> --}}
    <hr>
    <div class="row">
        <div class="col-md-4 card card-body">
            @if (isset($post_image))
            <div class="owl-carousel owl-theme slider" id="gallery">
                @foreach ($post_image as $img)
                <div><img alt="image" src="{{ asset('storage/' . $img->name) }}"></div>
                @endforeach
            </div>
            @else
            <div class="owl-carousel owl-theme slider" id="gallery">
                <div id="photo-slide-0"><img alt="image" src="{{ asset('gambar/no-image.jpg') }}"></div>
            </div>
            @endif
            <div id="photo-form" class="form-group">
                <label>Photo</label>
                <input type="file" class="form-control my-1" name="photo[]" data-slide="0" id="photo-form-0" />
            </div>
            <div id="append-photo"></div>
            <div id="groupContButton" class="form-group w-100 text-right">
                <button id="btn-del-photo" type="button" class="btn btn-primary" disabled="">-</button>
                <button id="btn-add-photo" type="button" class="btn btn-primary">+</button>
            </div>
        </div>
        <div class="col-md-8 card card-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                            value="{{ old('title', $fields->title) }}" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control select2" id="category_id" name="category_id">
                            @foreach ($post_category as $r)
                            <option value="{{ $r->id }}" {{ $fields->category_id == $r->id ? 'selected' : '' }}>
                                {{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Tag</label>
                        <select type="text" id="tags-input" class="form-control" name="tags[]" multiple="multiple">
                            @if(old('tags'))
                            @foreach(old('tags') as $tag)
                            <option value="{{$tag}}">{{$tag}}</option>
                            @endforeach
                            @else
                            @if (isset($tags))
                            @foreach ($tags as $tag)
                            <option value="{{$tag}}">{{$tag}}</option>
                            @endforeach
                            @endif
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control selectric" name="status">
                            <option value="P">Publish</option>
                            <option value="D">Draft</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="description"
                            class="summernote form-control">{{ old('description', $fields->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>
    </div>

    @endsection

    @section('script')

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                swal("Error", "{{ $error }}")
            @endforeach
        @endif

        @if ($message = Session::get('success'))
            swal("Success!", "{{ $message }}");
        @endif
    </script>

    <script>
        $(document).ready( function() {
            $("#gallery").owlCarousel({
                items:1,
                // margin:10,
                autoHeight:true,
                nav: true,
                dots: false,
                navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
            });

            var countimg = 0;

            $('#btn-add-photo').click(function(){
                countimg++;
                var src="{{ asset('gambar/no-image.jpg') }}";
                var clone_photoform= $('#photo-form-0').clone().attr('id',`photo-form-${countimg}`);
                // var clone_photoslide= $('#photo-slide-0').clone().attr('id',`photo-slide-0-${countimg}`);
                $('#gallery').trigger('add.owl.carousel', ['<div id="photo-slide-'+countimg+'"><img alt="image" src="'+src+'"></div>'])
                    .trigger('refresh.owl.carousel');

                $('#photo-form').append(clone_photoform);
                // $('#gallery').append(clone_photoslide);
                $('#btn-del-photo').prop('disabled',false);
                // $(`#section-photos-${countimg} [name='order_image[]']`).val(countimg + 1);
                $(`#photo-form-${countimg}`).val('');
                $(`#photo-form-${countimg}`).attr('data-slide', countimg);
                // $(`#photo-slide-${countimg}`).attr('src', src);
                // $(`#section-photos-${countimg} .btn-insert`).attr('id',`btn-insert-${countimg}`);
                console.log(countimg)
            });

            $('#btn-del-photo').click(function(){
                $("#gallery").trigger('remove.owl.carousel', [countimg]).trigger('refresh.owl.carousel');
                $(`#photo-form-${countimg}`).remove();
                if(countimg > 1){
                    countimg--;
                } else {
                    $(this).prop('disabled',true);
                    countimg=0;
                }
                console.log(countimg)
            });

            $('#tags-input').tagsinput();

            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) { 
                    e.preventDefault();
                    return false;
                }
            });

            function readURL(input, photoid) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(`#photo-slide-${photoid} img`).attr('src',e.target.result)
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#photo-form').on('change', 'input[id^=photo-form-]', function() {
                alert($(this).attr('data-slide'));
                var photoid = $(this).attr('data-slide');
                readURL(this,photoid);
            });

            // $("input[name='photo[]']").change(function(){
            //     alert($(this).attr('data-slide'));
            //     var photoid = $(this).attr('data-slide');
            //     // if( $("input[name='photo[]']").val()!=""){
            //     //     $('#blah').show('slow');
            //     // }
            //     // else{
            //     //     $('#remove').hide();$('#blah').hide('slow');
            //     // }
            //     readURL(this,photoid);
            // });

        });
    </script>
    @endsection