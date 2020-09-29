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
                <div class="row">
                    <div class="col-md-8">
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
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea name="description"
                                        class="summernote form-control">{{ old('description', $fields->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="my-2 border">
                                    @if ($state == 'create')
                                    <img id='img-upload' class="img-fluid" src="{{ asset('gambar/no-image.jpg') }}" />
                                    @elseif($state == 'update')
                                    @if ($fields->photo())
                                    <img id='img-upload' class="img-fluid"
                                        src="{{ asset('storage/' . $fields->photo()) }}" />
                                    @else
                                    <img id='img-upload' class="img-fluid" src="{{ asset('gambar/no-image.jpg') }}" />
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
            //     ajax: {
            //     url: '{{ url('post/tags') }}',
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