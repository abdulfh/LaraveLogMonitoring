@extends('layouts.app')
@section('page_name')
    Logger
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
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
              $.each( data, function( key, val ) {
                $log.prepend( "<li>" + val + "</li>" );
              });
            });

        },5000);
    });
</script>
@endpush