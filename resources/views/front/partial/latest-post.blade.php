<div class="col-lg-6 col-sm-12">
    <div class="heading2">
        <h4 class="fw-700">All <span class="text-primary">Post</span></h4>
    </div>
    <div id="posts" class="row">
        {{-- Ajax called --}}
    </div>
</div>


@section('script')
<script>    
    $(document).ready(function(){
        var _token = $('meta[name="csrf-token"]').attr('content');
        load_data('', _token);

        function load_data(id="", _token){
            $.ajax({
                url:"{{ route('post.load_data') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data){
                    $('#counter').remove();
                    $('#loadpost').remove();
                    $('#posts').append(data);
                }
            })
        }

        // var scrollLoad = true;
        // $(window).scroll(function(){
        //     if (scrollLoad && ($(document).height() - $(window).height())-$(window).scrollTop()<=100){
        //         // fetch data when we are 800px above the document end
        //         var id = $('#counter').data('id');
        //         alert(id);
        //         // $('#counter').html('<b>Loading...</b>');
        //         load_data(id, _token);
        //         scrollLoad = false;
        //     }
        // });

        // $(window).scroll(function() {
        //     if($(window).height() + $(window).scrollTop() == $(document).height()) {
        //         var id = $('#counter').data('id');
        //         alert(id);
        //         // $('#counter').html('<b>Loading...</b>');
        //         load_data(id, _token);
        //     }
        // });

        $(document).on('click', '#loadpost', function(){
            var id = $(this).data('id');
            $('#loadpost').html('<b>Loading...</b>');
            load_data(id, _token);
        });

    });

</script>
@endsection