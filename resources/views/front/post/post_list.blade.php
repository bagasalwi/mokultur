@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                @include('layouts.side-profile')
            </div>
            <div class="col-md-8 col-sm-12">
                @include('layouts.top-menu')
                <div class="card">
                    <div class="card-header">
                        <h4>My Post</h4>
                        <div class="card-header-action">
                            <a href="{{ url($url_create) }}" class="btn btn-outline-primary">CREATE POST</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No
                                        </th>
                                        <th>Title</th>
                                        <th>status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp

                                    @foreach ($post as $row)

                                    @php
                                    
                                    if($row->status == 'P'){
                                        $status = 'Published';
                                        $s_color = 'success';
                                    }else if($row->status == 'D'){
                                        $status = 'Draft';
                                        $s_color = 'danger';
                                    }
                                    
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td style="width:50%">{{ $row->title }}</td>
                                        <td>
                                            <span class="badge badge-{{ $s_color }}">{{ $status }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ $url_update }}/{{ $row->slug }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger" onclick="deletePost({{ $row->id }})"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="float-right">
                                {{ $post->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

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
            url: "{{ url('post/delete') }}" + "/" + id,
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

@section('script')
@if ($message = Session::get('success'))
<script>
    swal("Success!", "{{ $message }}");
</script>
@endif
@endsection