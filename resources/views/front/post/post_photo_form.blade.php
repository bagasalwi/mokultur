@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row m-2">
            <form action="{{ url('post/save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $fields->id }}">
                <input type="hidden" name="state" value="{{ $state }}">

                <div class="row">
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
                </div>
                <hr>
                <div id="gallery" class="row"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control" name="photo[]" id="imgInp" multiple />
                                </div>
                            </div>
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
                                        <option value="{{ $r->id }}"
                                            {{ $fields->category_id == $r->id ? 'selected' : '' }}>
                                            {{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Tag</label>
                                    <select type="text" id="tags-input" class="form-control" name="tags[]"
                                        multiple="multiple">
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
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="description"
                                class="summernote form-control">{{ old('description', $fields->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
            $('#tags-input').tagsinput();

            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) { 
                    e.preventDefault();
                    return false;
                }
            });

            $(function() {
                var imagesPreview = function(input, placeToInsertImagePreview) {
                    if (input.files) {
                        var filesAmount = input.files.length;
                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();
                            reader.onload = function(event) {
                                // var col = $($.html('<img class="img-fluid">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                                $($.parseHTML('<div class="col-3"><img width="250" height="250" src="'+event.target.result+'"></div>')).appendTo(placeToInsertImagePreview);
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                };

                $('#imgInp').on('change', function() {
                    $("div#gallery").html("");
                    imagesPreview(this, 'div#gallery');
                });
            });

        });
    </script>
    @endsection