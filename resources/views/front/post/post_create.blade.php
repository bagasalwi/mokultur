@extends('front.layouts.master')

@section('content')
@foreach ($fields as $fields)
<section class="section">
    <div class="container">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <strong>{{ $message }}</strong>
            </div>
        </div>
        @endif

        @if ($errors->any())
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
        @endif

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Membuat Post Baru</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" action="{{ url('post/save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $fields->id }}">
                            <input type="hidden" name="state" value="{{ $state }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Title" value="{{old('title')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tag</label>
                                        <select class="form-control select2-new" name="tags[]" multiple="multiple">
                                            @foreach($tags as $tag => $val)
                                            <option value='{{ $tag }}'>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea name="description"
                                            class="summernote form-control">{{old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <input type="file" name="thumbnail" id="imgInp" />
                                        @if ($fields->thumbnail)
                                        <img width="250" height="250" id='img-upload'
                                            src="{{ URL::asset('gambar/user_post/'. $fields->thumbnail)}}" />
                                        @else
                                        <img width="250" height="250" id='img-upload' />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
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
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Buat Post</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endforeach

@endsection

@section('script')
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