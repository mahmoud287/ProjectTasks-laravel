@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit sub Task</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('subTask.update',$subTask->id) }}">
                        {{ csrf_field() }}
                        @method('PUT')
                        <input type="hidden" name="task_id" value="{{$subTask->task_id}}">
                        <div class="form-group">
                            <label for="title">Task Title</label>
                            <input required type="text" value="{{ $subTask->title }}" class="form-control" id="title"
                                name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Task Description</label>
                            <textarea required class="form-control" id="description" name="description"
                                rows="3">{{ $subTask->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
