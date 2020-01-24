@extends('layouts.app')
@section('page_name')
    Logger List <a href="{{route('logger.create')}}" class="ml-3 btn btn-primary"><i class="fas fa-plus"></i> Add Logger</a>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Logger Name</th>
                            <th scope="col">Logger Path</th>
                            <th scope="col" class="text-center" colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($logger as $item)
                                <tr>
                                    <td>{{$num++}}</td>
                                    <td>{{$item->log_name}}</td>
                                    <td>{{$item->log_path}}</td>
                                    <td>
                                        <a  class="btn btn-primary" href="{{ route('logger.edit',$item->id) }}">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{route('logger.destroy', $item->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="12">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection