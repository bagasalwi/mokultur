@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row m-2">
            <form action="{{ url('review/save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $fields->id }}">
                <input type="hidden" name="state" value="{{ $state }}">

                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="mr-auto">
                            <h2 class="text-dark">Review Content</h2>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="row">
                            <div class="col-6 my-2">
                                <a href="{{ route('review.index') }}" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                            <div class="col-6 my-2">
                                <button type="submit" class="btn btn-dark btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stickydiv">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="my-2 bd-radius-8 border" data-toggle="tooltip" data-placement="top" title="Foto akan disesuaikan dengan ukuran poster, jika size melebihi akan tercover">
                                        @if ($state == 'create')
                                        <img id='img-upload' class="img-fluid bd-radius-8" src="{{ asset('gambar/no-image.jpg') }}" />
                                        @elseif($state == 'update')
                                        @if ($fields->review_image)
                                        <img id='img-upload' class="img-fluid bd-radius-8"
                                            src="{{ asset('storage/' . $fields->review_image) }}" />
                                        @else
                                        <img id='img-upload' class="img-fluid bd-radius-8" src="{{ asset('gambar/no-image.jpg') }}" />
                                        @endif
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Review Image <small class="text-danger">*as Thumbnail</small></label>
                                        <input type="file" class="form-control" name="review_image" id="imgInp" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control selectric" name="status" required>
                                            <option {{ $fields->status == '' ? 'selected' : '' }} value="">Select Status</option>
                                            <option value="P" {{ $fields->status == 'P' ? 'selected' : '' }}>Publish</option>
                                            <option value="D" {{ $fields->status == 'D' ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card card-body bd-radius-4 shadow-sm mb-3">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>What to Review?</label>
                                        <input type="text" class="form-control" id="review_name" name="review_name" placeholder="Movie,Anime,Game..."
                                            value="{{ old('review_name', $fields->review_name) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>What kind of Genre?</label>
                                        <select type="text" id="tags-input" class="form-control" name="review_genre[]" placeholder="Action, Romance.."
                                            multiple="multiple">
                                            @if(old('review_genre'))
                                                @foreach(old('review_genre') as $tag)
                                                    <option value="{{$tag}}">{{$tag}}</option>
                                                @endforeach
                                            @else
                                               @if (isset($review_genre))
                                                    @foreach ($review_genre as $tag)
                                                        <option value="{{$tag}}">{{$tag}}</option>
                                                    @endforeach
                                               @endif
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Release Date</label>
                                        <input type="text" class="form-control datepicker" id="review_releasedate" name="review_releasedate" placeholder="Release Date"
                                            value="{{ old('review_releasedate', $fields->review_releasedate) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Publisher or Studio?</label>
                                        <input type="text" class="form-control" id="review_studio" name="review_studio" placeholder="Review Studio"
                                            value="{{ old('review_studio', $fields->review_studio) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Link to Source</label>
                                        <input type="text" class="form-control" id="review_link" name="review_link" placeholder="Official Source, Redirect link.."
                                            value="{{ old('review_link', $fields->review_link) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Plot/Synopsis</label>
                                        <textarea name="review_synopsis" rows="2" cols="50"
                                            class="summernote-simple form-control">{{ old('review_synopsis', $fields->review_synopsis) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body bd-radius-4 shadow-sm mb-2">
                            <div class="row">
                                <div class="col-md-9 col-sm-12">
                                    <div class="form-group">
                                        <label>Your Review Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                            value="{{ old('title', $fields->title) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Your Score</label>
                                        <input type="text" class="form-control" id="score" name="score" placeholder="Your Score"
                                            value="{{ old('score', $fields->score) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Your Review Content</label>
                                        <textarea name="content" rows="2" cols="50"
                                            class="summernote form-control">{{ old('content', $fields->content) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>I'll Recommend You If..</label>
                                        <textarea name="recommend"
                                            class="form-control">{{ old('recommend', $fields->recommend) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>I'll Unrecommend You If..</label>
                                        <textarea name="unrecommend" 
                                            class="form-control">{{ old('unrecommend', $fields->unrecommend) }}</textarea>
                                    </div>
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