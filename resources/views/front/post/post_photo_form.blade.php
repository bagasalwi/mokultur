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
            <input type="hidden" name="tipe_post" value="{{ $tipe_post }}">
            <input type="hidden" name="order_delete">

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body bd-radius-4 shadow">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <a href="{{ route('post.index') }}" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                            <div class="col-6 mb-2">
                                <button type="submit" class="btn btn-dark btn-block">Submit</button>
                            </div>
                        </div>
                        @if (isset($post_image))
                        <div class="owl-carousel owl-theme slider" id="gallery">
                            @foreach ($post_image as $idx=> $img)
                            <div id="photo-slide-{{ $idx + 1 }}"><img alt="image"
                                    src="{{ asset('storage/' . $img->name) }}"></div>
                            @endforeach
                        </div>
                        @else
                        <div class="owl-carousel owl-theme slider" id="gallery">
                            <div id="photo-slide-1"><img alt="image" src="{{ asset('gambar/no-image.jpg') }}"></div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <div id="order-photo" class="form-group">
                                    <label>Order</label>
                                    @if (isset($post_image))
                                    @foreach ($post_image as $idx=> $img)
                                    <input type="text" class="form-control mb-1" name="order_photo[]" readonly
                                        value="{{ $img->order }}" id="order-photo-{{ $idx + 1 }}" />
                                    @endforeach
                                    @else
                                    <input type="text" class="form-control mb-1" name="order_photo[]" readonly value="1"
                                        id="order-photo-1" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-9 col-9">
                                <div id="photo-form" class="form-group">
                                    <label>Photo</label>
                                    @if (isset($post_image))
                                    @foreach ($post_image as $idx=> $img)
                                    <input type="file" class="form-control mb-1" name="photo[]" value="{{ $img->name }}"
                                        data-slide="{{ $idx + 1 }}" id="photo-form-{{ $idx + 1 }}" />
                                    @endforeach
                                    @else
                                    <input type="file" class="form-control mb-1" name="photo[]" data-slide="1"
                                        id="photo-form-1" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="append-photo"></div>
                        <div id="groupContButton" class="form-group w-100 text-right">
                            <button id="btn-del-photo" type="button" class="btn btn-primary" disabled="">-</button>
                            <button id="btn-add-photo" type="button" class="btn btn-primary">+</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-body bd-radius-4 shadow">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control slugify" data-target="slug" id="title"
                                        name="title" placeholder="Title" value="{{ old('title', $fields->title) }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug"
                                        value="{{ old('slug', $fields->slug) }}" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
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
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control selectric" name="status">
                                        <option value="P" {{ $fields->status == 'P' ? 'selected' : '' }}>Publish
                                        </option>
                                        <option value="D" {{ $fields->status == 'D' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
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
                            <div class="col-md-12">
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
    @php
    if(isset($post_image)){
    if(count($post_image) > 1){
    $countimg = count($post_image);
    } else {
    $countimg = 1;
    }
    }else{
    $countimg = 1;
    }
    @endphp

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

            var owl = $("#gallery");
            var countimg= {{ $countimg }};
            var ord_del = [];

            $("#gallery").owlCarousel({
                items:1,
                // margin:10,
                autoHeight:true,
                nav: true,
                dots: false,
                navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
            });

            // owl.on('changed.owl.carousel', function (e) {
            //     console.log("current: ",e.relatedTarget.current())
            //     console.log("current: ",e.item.index) //same
            //     console.log("total: ",e.item.count)   //total
            // })

            if(countimg > 1){
                $('#btn-del-photo').prop('disabled',false);
            }else{
                $('#btn-del-photo').prop('disabled',true);
            }

            $('#title').on('keyup', function(){
                // alert(countimg);
            });

            $('#btn-add-photo').click(function(){
                countimg++;

                // alert(countimg);

                var src ="{{ asset('gambar/no-image.jpg') }}";
                var clone_photoform = $('#photo-form-1').clone().attr('id',`photo-form-${countimg}`);
                var clone_orderphoto = $('#order-photo-1').clone().attr('id',`order-photo-${countimg}`);

                $('#gallery').trigger('add.owl.carousel', ['<div id="photo-slide-'+countimg+'"><img alt="image" src="'+src+'"></div>'])
                    .trigger('refresh.owl.carousel');

                $('#photo-form').append(clone_photoform);
                $('#order-photo').append(clone_orderphoto);
                
                $('#btn-del-photo').prop('disabled',false);
                
                $(`#order-photo-${countimg}`).val(countimg);
                $(`#photo-form-${countimg}`).val('');
                $(`#photo-form-${countimg}`).attr('data-slide', countimg);

                // console.log(countimg)
            });

            $('#btn-del-photo').click(function(){
                // $("#gallery").trigger('remove.owl.carousel', [1]).trigger('refresh.owl.carousel');
                // alert(countimg);
                var count_caro = countimg - 1;
                $('#gallery').owlCarousel('remove', count_caro).owlCarousel('update');
                $(`#photo-form-${countimg}`).remove();
                $(`#order-photo-${countimg}`).remove();
                if(countimg > 2){
                    countimg--;
                } else {
                    $(this).prop('disabled',true);
                    countimg = 1;
                }
                // console.log(countimg)

                ord_del.push(countimg + 1);
                $('input[name=order_delete]').val(ord_del);
                // alert(ord_del);
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
                // alert($(this).attr('data-slide'));
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