@extends('front.layouts.master')

@section('content')

@foreach ($fields as $fields)
<section class="section">
    <div class="container">
        {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ $error }}
            </div>
        </div>
        @endforeach
        @endif --}}


        <div class="row m-2">
            <form class="forms-sample" action="{{ url('post/save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $fields->id }}">
                <input type="hidden" name="state" value="{{ $state }}">

                <div class="d-flex flex-row row">
                    <div class="col-md-6 col-sm-12">
                        <div class="mr-auto">
                            <h2 class="text-dark">Post Content</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="float-right">
                            <a href="{{ route('post.index') }}" class="btn btn-danger px-4">Cancel</a>
                            <button type="submit" class="btn btn-dark px-4">Submit</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label><h6 class="text-dark font-weight-normal">Title</h6></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                        value="{{ old('title', $fields->title) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label><h6 class="text-dark font-weight-normal">Category</h6></label>
                                    <select class="form-control select2" id="category_id" name="category_id">
                                        @foreach ($post_category as $r)
                                        <option value="{{ $r->id }}"
                                            {{ $fields->category_id == $r->id ? 'selected' : '' }}>
                                            {{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label><h6 class="text-dark font-weight-normal">Tag</h6></label>
                                    <select class="form-control select2-new" name="tags[]" multiple="multiple">
                                        @foreach($tags as $tag => $val)
                                        <option value='{{ $tag }}'>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label><h6 class="text-dark font-weight-normal">Content</h6></label>
                                    <textarea name="description"
                                        class="summernote form-control">{{ old('description', $fields->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h6 class="text-dark font-weight-normal">Photo</h6>
                                <div class="my-2">
                                    @if ($state == 'create')
                                    <img id='img-upload' class="img-fluid"
                                        src="{{ asset('gambar/no-image.jpg') }}" />
                                    @elseif($state == 'update')
                                    @if ($fields->photo())
                                    <img id='img-upload' class="img-fluid"
                                        src="{{ asset('storage/' . $fields->photo()) }}" />
                                    @else
                                    <img id='img-upload' class="img-fluid"
                                        src="{{ asset('gambar/no-image.jpg') }}" />
                                    @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="photo" id="imgInp" />
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label><h6 class="text-dark font-weight-normal">Status</h6></label>
                                    <select class="form-control selectric" name="status">
                                        <option value="P">Publish</option>
                                        <option value="D">Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    @endforeach

    @endsection

    @section('script')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <script>
            swal("Error", "{{ $error }}")
        </script>
        @endforeach
    @endif

    @if ($message = Session::get('success'))
    <script>
        swal("Success!", "{{ $message }}");
    </script>
    @endif

    <script>
        $(document).ready( function() {
            $('.select2-new').select2();

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