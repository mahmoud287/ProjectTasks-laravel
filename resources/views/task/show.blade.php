@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success mb-3">
        <p>{{ $message }}</p>
    </div>
    @endif
    {{-- task --}}
    <div class="card mb-3">
        <div class="card-header font-weight-normal text-monospace">
            {{ $task->title}}
        </div>
        <div class="card-body">
            <p class="card-text">{{$task->description}}</p>
        </div>
    </div>

    {{-- comments --}}
    <form method="POST" action="/comment">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="hidden" name="task_id" value="{{$task->id}}">
            <input type="text" placeholder="Type Comment" name="comment" class="form-control">
        </div>
    </form>
    @if ($comments->count())

    <div class="alert alert-primary text-center" role="alert">
        Task Comments
    </div>
    @foreach ($comments as $comment)
    <div class="card mb-3 text-center">
        <p class="card-text">{{$comment->comment}}</p>
    </div>
    @endforeach
    {{$comments}}

    @else
    <div class="alert alert-danger text-center" role="alert">
        there is no Comments for this Task.
    </div>
    @endif

    {{--sub tasks --}}
    @can('isAdmin')
    <a class="btn btn-primary my-3" href="{{ route('subTask.create', ['task_id'=>$task->id]) }}" role="button">Creat new
        Sub Task</a>
    @endcan
    @if ($subTasks->count())
    <div class="alert alert-primary text-center" role="alert">
        Sub Tasks
    </div>
    @foreach ($subTasks as $task)
    <div class="card mb-3 cursor">
        <div class="card-header font-weight-normal text-monospace">
            {{ $task->title}}
            <div class="float-right d-flex">
                @can('isAdmin')
                <form action="{{ route('subTask.destroy',$task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary mr-2" type="submit">Delete</button>
                </form>
                @endcan
                @can('isEng')
                <a class="btn btn-primary" href="{{ route('subTask.edit', $task->id) }}" role="button">Edit</a>
                @endcan
            </div>
        </div>
        <div class="card-body text-center">
            <p class="card-text">{{$task->description}}</p>
        </div>
    </div>
    @endforeach
    {{$subTasks}}
    @else
    <div class="alert alert-danger text-center" role="alert">
        there is no sub Tasks tasks for this Task.
    </div>
    @endif
</div>
@endsection
