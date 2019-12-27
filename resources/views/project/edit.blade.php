@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Project</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('project.update',$project->id) }}">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="user">User</label>
                            <select class="form-control" id="user" name="user_id">
                                @foreach ($users_list as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Project Title</label>
                            <input required type="text" value="{{ $project->title }}" class="form-control" id="title"
                                name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Project Description</label>
                            <textarea required class="form-control" id="description" name="description"
                                rows="3">{{ $project->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
