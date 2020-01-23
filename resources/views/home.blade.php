@extends('layouts.app')
@section('page_name')
    Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row">
        @foreach ($logger as $item)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{$item->log_name}} 
                    <a  class="ml-3 btn btn-primary" href="{{ route('logger.show',$item->id) }}"><i class="fas fa-eye"></i> View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
