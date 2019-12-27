@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Task</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('task.update',$task->id) }}">
                        {{ csrf_field() }}
                        @method('PUT')
                        <input type="hidden" name="project_id" value="{{$task->project_id}}">
                        <div class="form-group">
                            <label for="title">Task Title</label>
                            <input required type="text" value="{{ $task->title }}" class="form-control" id="title"
                                name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Task Description</label>
                            <textarea required class="form-control" id="description" name="description"
                                rows="3">{{ $task->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
