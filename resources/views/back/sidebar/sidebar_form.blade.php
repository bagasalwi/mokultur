@extends('back.layouts.master')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Sidebar</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Sidebar</h2>
            <p class="section-lead">
                Menambahkan sidebar untuk user maupun admin.
            </p>
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
                        <form class="forms-sample" action="{{ url('sidebar/save') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id" value="{{ $fields->id }}">
                            <input type="hidden" name="state" value="{{ $state }}">

                            <div class="card-header">
                                <h4>Sidebar Forms</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Menu Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Menu Name" value="{{ $fields->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Icon Menu</label>
                                            <input type="text" class="form-control" id="icon" name="icon"
                                                placeholder="example : fas fa-home" value="{{ $fields->icon }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Url Menu</label>
                                            <input type="text" class="form-control" id="url" name="url"
                                                placeholder="Url for accessing menu" value="{{ $fields->url }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Priviliges</label>
                                            <select class="form-control select2" id="role_id" name="role_id">
                                                @foreach ($roles as $r)
                                                <option value="{{ $r->id }}"
                                                    {{ $fields->role_id == $r->id ? 'selected' : '' }}>{{ $r->name }}
                                                </option>
                                                @endforeach
                                            </select>
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