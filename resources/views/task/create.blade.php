@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Task</div>
                <div class="card-body">
                    <form method="POST" action="/task">
                        {{ csrf_field() }}
                        <input type="hidden" name="project_id" value="{{app('request')->input('project_id')}}">
                        <div class="form-group">
                            <label for="title">Task Title</label>
                            <input required type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Task Description</label>
                            <textarea required class="form-control" id="description" name="description"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
