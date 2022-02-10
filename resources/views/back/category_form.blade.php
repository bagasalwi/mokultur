@extends('back.layouts.master')

@section('adminContent')
<!-- Main Content -->
@foreach ($fields as $fields)
<div class="main-content">
    <section class="section">
        <div class="container">
            <h4>Category {{ $state }}</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form class="forms-sample" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="state" value="{{ $state }}" hidden>
                            <input type="text" name="id" value="{{ $fields->id }}" hidden>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $fields->name }}" placeholder="Menu Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea type="text" class="form-control" id="description"
                                                name="description" placeholder="description" cols="30"
                                                rows="10">{{ $fields->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Banner Background</label>
                                            <input type="file" class="form-control" id="banner" name="banner"
                                                placeholder="Banner">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endforeach
@endsection