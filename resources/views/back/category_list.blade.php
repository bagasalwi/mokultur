@extends('back.layouts.master')

@section('adminContent')
<!-- Main Content -->
<div class="container">
    <h1>Category <small>(Total : {{ count($postcategory) }} Category)</small></h1>

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
                            <td class="text-center">
                                <a class="btn btn-info" href="{{ url('admin/category/update/' . $row->id) }}"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger"
                                    onclick="deleteCategory({{ $row->id }})"><i
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
</script>
@endsection