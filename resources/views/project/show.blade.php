@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success mb-3">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card mb-3">
        <div class="card-header font-weight-bold">
            {{ $project->title}}
            @can('isAdmin')
            <a class="btn btn-primary float-right" href="{{ route('task.create', ['project_id'=>$project->id]) }}"
                role="button">Create
                New Task</a>
            @endcan
        </div>
        <div class="card-body">
            <p class="card-text">{{$project->description}}</p>
        </div>
    </div>

    @if ($tasks->count())

    <div class="alert alert-primary text-center" role="alert">
        Project Tasks
    </div>

    @foreach ($tasks as $task)
    <a href="{{ route('task.show',$task->id) }}">
        <div class="card mb-3 cursor">
            <div class="card-header font-weight-normal text-monospace">
                {{ $task->title}}
                <div class="float-right d-flex">
                    @can('isAdmin')
                    <form action="{{ route('task.destroy',$task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary mr-2" type="submit">Delete</button>
                    </form>
                    @endcan
                    @can('isEng')
                    <a class="btn btn-primary" href="{{ route('task.edit', $task->id) }}" role="button">Edit</a>
                    @endcan
                </div>
            </div>
            <div class="card-body text-center">
                <p class="card-text">{{$task->description}}</p>
            </div>
        </div>
        <a />
        @endforeach
        {{$tasks}}

        @else
        <div class="alert alert-danger text-center" role="alert">
            there is no tasks for this project.
        </div>

        @endif
</div>
@endsection
