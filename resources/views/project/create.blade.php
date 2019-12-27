@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Project</div>
                <div class="card-body">
                    <form method="POST" action="/project">
                        {{ csrf_field() }}
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
                            <input required type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Project Description</label>
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
