@extends('back.layouts.master')

@section('adminContent')
<!-- Main Content -->
<div class="container">
    <div class="section-header">
        <h1>User</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table-1">
                    <thead>
                        <tr>
                            <th class="text-center">
                                No
                            </th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Instagram</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp

                        @foreach ($user as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->username }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->instagram }}</td>
                            <td class="text-center">
                                <a href="{{ url('creator/'. $row->username ) }}" class="btn btn-info"><i
                                        class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection