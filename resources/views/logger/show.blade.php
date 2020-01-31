@extends('layouts.app')
@section('page_name')
    Logger
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body overflow-auto" style="max-height:500px">
                    <ul id="msg"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('javascript')
<script>
    $(document).ready(function() {
        var url =  "{!! route('logger.api', $logger->id) !!}"
        setInterval(function(){
            $.getJSON(url, function( data ) {
                var $log = $('#msg');
                console.log(data);
                if (data.status == 'success') {
                    $.each( data.value, function( key, val ) {
                            $log.append( "<li>" + val + "</li>" );
                    });
                }
            });
        },2000);
    });
</script>
@endpush