@extends('layouts.app')
@section('page_name')
    Edit Logger
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('logger.update', $logger->id) }}">
                         @csrf
                         @method('PUT')
                       <div class="form-group">
                         <label for="email">Log Name</label>
                         <input id="logname" type="text" class="form-control @error('logname') is-invalid @enderror" placeholder="My Log name" name="log_name" value="{{$logger->log_name}}" autofocus>
                         @error('logname')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                       </div>
         
                       <div class="form-group">
                         <div class="d-block">
                             <label for="password" class="control-label">Log Path</label>
                         </div>
                         <input id="logpath" type="text" class="form-control @error('logpath') is-invalid @enderror" placeholder="/path/to/very/important.log" value="{{$logger->log_path}}" name="log_path">
                         @error('logpath')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                       </div>

                       <div class="form-group">
                         <button type="submit" class="btn btn-primary btn-lg" tabindex="4"><i class="fas fa-plus"></i>  Add Log</button>
                         <a href="{{route('logger.index')}}" role="button" class="btn btn-lg" tabindex="4">Cancel</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection