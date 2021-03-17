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
        <form action="{{ url('post/save') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $fields->id }}">
            <input type="hidden" name="state" value="{{ $state }}">
            <input type="hidden" name="tipe_post" value="{{ $tipe_post }}">

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body bd-radius-4 shadow">
                        <div class="row">
                            <div class="col-6 mb-1">
                                <a href="{{ route('post.index') }}" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                            <div class="col-6 mb-1">
                                <button type="submit" class="btn btn-dark btn-block">Submit</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="my-2" data-toggle="tooltip" data-placement="left" title="Jika size foto melebihi, foto akan tercover">
                                    @if ($state == 'create')
                                    <img id='img-upload' class="img-fluid mx-auto d-block bd-radius-8"
                                        src="{{ asset('gambar/no-image.jpg') }}" />
                                    @elseif($state == 'update')
                                    @if ($fields->photo())
                                    <img id='img-upload' class="img-fluid mx-auto d-block bd-radius-8"
                                        src="{{ asset('storage/' . $fields->photo()) }}" />
                                    @else
                                    <img id='img-upload' class="img-fluid mx-auto d-block bd-radius-8"
                                        src="{{ asset('gambar/no-image.jpg') }}" />
                                    @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control" name="photo" id="imgInp" />
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control selectric" name="status" required>
                                        <option {{ $fields->status == '' ? 'selected' : '' }} value="">Select
                                            Status</option>
                                        <option value="P" {{ $fields->status == 'P' ? 'selected' : '' }}>Publish
                                        </option>
                                        <option value="D" {{ $fields->status == 'D' ? 'selected' : '' }}>Draft
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-body bd-radius-4 shadow">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control slugify" data-target="slug"
                                        id="title" name="title" placeholder="Title"
                                        value="{{ old('title', $fields->title) }}" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        placeholder="slug" value="{{ old('slug', $fields->slug) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control select2" id="category_id" name="category_id"
                                        required>
                                        <option value="">- Select Category -</option>
                                        @foreach ($post_category as $r)
                                        <option value="{{ $r->id }}"
                                            {{ $fields->category_id == $r->id ? 'selected' : '' }}>
                                            {{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Tag</label>
                                    <select type="text" id="tags-input" class="form-control cari" name="tags[]"
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
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group content">
                                    <label>Content</label>
                                    <textarea name="description"
                                        class="summernote form-control">{{ old('description', $fields->description) }}</textarea>
                                </div>
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
            $('#tags-input').tagsinput();

            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) { 
                    e.preventDefault();
                    return false;
                }
            });

            // $('.cari').select2({
            //     placeholder: 'Cari...',
            //     tags: true,
            //     ajax: {
            //     url: '{{ url('admin/tag_ajax') }}',
            //     dataType: 'json',
            //     delay: 250,
            //     processResults: function (data) {
            //         return {
            //         results:  $.map(data, function (item) {
            //             return {
            //             text: item.name,
            //             id: item.id
            //             }
            //         })
            //         };
            //     },
            //     cache: true
            //     }
            // });

            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function(event, label) {
                var input = $(this).parents('.form-group').find(':text'),
                    log = label;
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                readURL(this);
            });

        });
    </script>
    @endsection