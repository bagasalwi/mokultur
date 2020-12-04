@extends('back.layouts.master')

@section('adminContent')
<!-- Main Content -->
<div class="container">
    <div class="d-flex flex-row">
        <h2>Category</h2>
        <h4 class="ml-auto align-self-end font-weight-normal">Total : {{ count($postcategory) }} Category</h4>
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
                            <th>Description</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp

                        @foreach ($postcategory as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->description }}</td>
                            <td>
                                @if ($row->status == 'A')
                                    <span class="badge badge-dark">Active</span>
                                @elseif($row->status == 'E')
                                    <span class="badge badge-danger">EVENT</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-info" href="{{ url('admin/category/update/' . $row->id) }}"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger" onclick="deleteCategory({{ $row->id }})"><i class="fas fa-trash"></i></button>
                                {{-- @if ($row->status != 'E')
                                <button class="btn btn-dark" onclick="makeEvent({{ $row->id }})">Set as Event</button>
                                @endif --}}
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
    function deleteCategory(id){       
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
            url: "{{ url('admin/category/delete') }}" + "/" + id,
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

    function makeEvent(id){       
        swal({
        title: "Are you sure?",
        text: "Are your sure want to make event this row data?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
            $.ajax({
            url: "{{ url('admin/category/event') }}" + "/" + id,
            success: function(){
                swal("Done!","It was succesfully selected as Event!","success");
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