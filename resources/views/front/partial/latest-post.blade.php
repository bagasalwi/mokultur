<div class="col-lg-6 col-sm-12">
    <div class="heading2">
        <h4 class="fw-600">MOKULTUR <span class="font-weight-bold">BLOG</span></h4>
    </div>
    <div id="posts" class="row">        
    </div>
</div>


@push('script')
<script>    
    $(document).ready(function(){
        var _token = $('meta[name="csrf-token"]').attr('content');
        load_data('', _token);

        $("#carousel-post").owlCarousel({
            items:1,
            // margin:10,
            autoHeight:true,
            nav: true,
            dots: false,
            navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
        });

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

        $(document).on('click', '#loadpost', function(){
            var id = $(this).data('id');
            $('#loadpost').html('<b>Loading...</b>');
            load_data(id, _token);
        });

    });

</script>
@endpush