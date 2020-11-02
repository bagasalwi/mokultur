@extends('back.layouts.master')

@section('adminContent')
<!-- Main Content -->
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="col-11">
                <h4>Sidebar List</h4>
            </div>
            <div class="col-1">
                <a href="{{ $url_create }}" class="btn btn-primary">Create New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th class="text-center">
                                No
                            </th>
                            <th>Name</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Created Date</th>
                            <th>Update Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp

                        @foreach ($sidebar_array as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->url }}</td>
                            <td><i class="{{ $row->icon }}"></i></td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{ $url_update }}/{{ $row->id }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-danger"
                                    onclick="deleteSidebar({{ $row->id }})"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    function deleteSidebar(id){       
        swal({
        title: "Are you sure?",
        text: "Are your sure want to delete this row data?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
            $.ajax({
            url: "{{ url('sidebar/delete') }}" + "/" + id,
            success: function(){
                swal("Done!","It was succesfully deleted!","success");
                setInterval('window.location.reload()', 1000);
            },
            error: function(){
                swal("Error!", "", "Error");
            }});
        }
      });
    }
</script>
@endsection