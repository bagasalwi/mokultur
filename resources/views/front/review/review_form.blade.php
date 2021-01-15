@extends('front.layouts.master')

@section('content')
<div class="jumbotron jumbotron-fluid primary-pattern-1 mb-0"
    style="padding-bottom: 80px; margin-bottom: -170px !important;">
    <div class="container section">
        <div class="row">
            <div class="col-12 align-self-center">
                <h1 class="text-white font-weight-bold" data-font-size="38px">Review Content</h1>
                <p class="mb-3 text-white" data-font-size="18px">
                    Create your own Reviews? But you need to add the Review desc first!
                </p>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="container">
        <form action="{{ url('review/save') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $fields->id }}">
            <input type="hidden" name="state" value="{{ $state }}">

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bd-radius-4 shadow stickydiv">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="mb-1 bd-radius-4" data-toggle="tooltip" data-placement="top"
                                    title="Foto akan disesuaikan dengan ukuran poster, jika size melebihi akan tercover">
                                    @if ($state == 'create')
                                    <img id='img-upload' class="img-fluid img-imagereview mx-auto d-block bd-radius-4"
                                        src="{{ asset('gambar/no-image.jpg') }}" />
                                    @elseif($state == 'update')
                                    @if ($fields->review_image)
                                    <img id='img-upload' class="img-fluid img-imagereview mx-auto d-block bd-radius-4"
                                        src="{{ asset('storage/' . $fields->review_image) }}" />
                                    @else
                                    <img id='img-upload' class="img-fluid img-imagereview mx-auto d-block bd-radius-4"
                                        src="{{ asset('gambar/no-image.jpg') }}" />
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
                                        <option {{ $fields->status == '' ? 'selected' : '' }} value="">Select Status
                                        </option>
                                        <option value="P" {{ $fields->status == 'P' ? 'selected' : '' }}>Publish
                                        </option>
                                        <option value="D" {{ $fields->status == 'D' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card bd-radius-4 shadow-sm mb-3">
                        <div class="card-header d-flex flex-row">
                            <div class="mr-auto">
                                <h6 class="no-pm">Your Review Information</h6>
                            </div>
                            <a href="{{ route('review.index') }}" class="btn btn-danger mx-1">Cancel</a>
                            <button type="submit" class="btn btn-dark mx-1">Submit</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>What to Review?</label>
                                        <input type="text" class="form-control" id="review_name" name="review_name"
                                            placeholder="Movie,Anime,Game..."
                                            value="{{ old('review_name', $fields->review_name) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>What kind of Genre?</label>
                                        <select type="text" id="tags-input" class="form-control" name="review_genre[]"
                                            placeholder="Action, Romance.." multiple="multiple">
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
                                        <input type="text" class="form-control datepicker" id="review_releasedate"
                                            name="review_releasedate" placeholder="Release Date"
                                            value="{{ old('review_releasedate', $fields->review_releasedate) }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Publisher or Studio?</label>
                                        <input type="text" class="form-control" id="review_studio" name="review_studio"
                                            placeholder="Review Studio"
                                            value="{{ old('review_studio', $fields->review_studio) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Trailer Link (Youtube)</label>
                                        <input type="text" class="form-control" id="review_link" name="review_link"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Kode terakhir youtube https://www.youtube.com/watch?v={kode}"
                                            placeholder="Official Source, Redirect link.."
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

                    </div>
                    <div class="card card-body bd-radius-4 shadow-sm mb-2">
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                                <div class="form-group">
                                    <label>Your Review Title</label>
                                    <input type="text" class="form-control slugify" data-target="slug" id="title"
                                        name="title" placeholder="Title" value="{{ old('title', $fields->title) }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Your Score</label>
                                    <input type="text" class="form-control" id="score" name="score"
                                        placeholder="Your Score" value="{{ old('score', $fields->score) }}" required>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug"
                                        value="{{ old('slug', $fields->slug) }}" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group content">
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