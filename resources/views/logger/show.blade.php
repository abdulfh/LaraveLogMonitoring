@extends('layouts.app')
@section('page_name')
    Logger
@endsection
@section('content')
<div class="container">
    {{$logger}}
</div>
@endsection