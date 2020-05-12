@extends('back.layouts.master')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Post Category Forms</h1>
        </div>

        <div class="section-body">
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

            @foreach ($fields as $fields)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form class="forms-sample" action="{{ url('post-category/save') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id" value="{{ $fields->id }}">
                            <input type="hidden" name="state" value="{{ $state }}">

                            <div class="card-header">
                                <h4>Post Category Forms</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Menu Name" value="{{ $fields->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" class="form-control" id="description" name="description"
                                                placeholder="description" value="{{ $fields->description }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection