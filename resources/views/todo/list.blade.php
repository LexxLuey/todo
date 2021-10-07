@extends('layouts.app')

@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Todos List</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ route('todo.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new todo</a>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" >
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" >
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Task Name</th>
                        <th width="15%"><center>Date Created</center></th>
                        <th width="10%"><center>Task Status</center></th>
                        <th width="20%"><center>Action</center></th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($todos as $key => $todo )
                    <tr>
                        <th>{{ $key+1 }}</th>
                        <td>{{ $todo->title }}</td>
                        <td><center>{{ $todo->created_at->format('Y-m-d') }}</center></td>
                        {{-- <td><center>{{ $todo->created_at->diffForHumans() }}</center></td> --}}
                        <td><center>{{ $todo->status }}</center></td>
                        <td>
                            <div class="row ml-1 p-2 mx-auto">
                                <div class="action_btn ml-1 p-1">
                                    <a href="{{ route('todo.show', $todo)}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="action_btn ml-1 p-1">
                                    <a href="{{ route('todo.edit', $todo)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="action_btn ml-1 p-1">
                                    <form action="{{ route('todo.destroy', $todo)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                    <td colspan="4"><center>No data found</center></td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {!! $todos->links() !!}
            </div>

        </div>
    </div>
</div>
@endsection
