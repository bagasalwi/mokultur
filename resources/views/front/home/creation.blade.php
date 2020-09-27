@extends('front.layouts.master')

@section('script')
<script>
    $('#search').on('keyup',function(){
        value = $(this).val();
        // alert($value);
        $.ajax({
            type : 'get',
            url : '{{ url('creation') }}',
            data:{'search' : value},
            success:function(data){
                var html = '';
                $.each(data,function(index, value){
                    html += value;
                });
                $('#posts').html(html);
                
            }
        });
    });

    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection

@section('content')
<div class="section">
    <div class="container">
        <div id="lmao"></div>
        <div class="my-4">
            <p class="no-pm">Showing result for :</p>
            <form action="{{ url('creation') }}" role="search">
                <input type="text" id="search" name="search" class="inputSearch" placeholder="Search..">
            </form>
            
        </div>
        {{-- @if (isset($search_meta))
        
        @endif --}}
        <div class="row">
            @include('front.partial.index-post')
            @include('front.partial.right-bar')
        </div>
    </div>
</div>
@endsection