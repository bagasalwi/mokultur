@extends('back.layouts.master')

@section('adminContent')
<!-- Main Content -->
<div class="container">
    <div class="d-flex flex-row">
        <h2>Article</h2>
        <h4 class="ml-auto align-self-end font-weight-normal">Total : {{ count($post) }} Article</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table-1">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>title</th>
                            <th>slug</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp

                        @foreach ($post as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->date_published }}</td>
                            <td class="text-center">
                                <a href="{{ route('post.detail',$row->slug) }}" class="btn btn-info"><i
                                        class="fas fa-eye"></i></a>
                                <button class="btn btn-danger" onclick="deletePost({{ $row->id }})"><i
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
    function deletePost(id){       
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
            url: "{{ url('admin/post/delete') }}" + "/" + id,
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