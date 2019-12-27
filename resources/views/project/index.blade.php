@extends('layouts.app')

@section('content')
<div class="container">
    {{-- session creating message  --}}
    @if ($message = Session::get('success'))
    <div class="alert alert-success mb-3">
        <p>{{ $message }}</p>
    </div>
    @endif

    {{-- check if there is projects or not --}}
    @if ($projects->count())

    @foreach ($projects as $project)
    <a href="{{ route('project.show',$project->id) }}">
        <div class="card mb-3 cursor">
            <div class="card-header font-weight-bold">
                {{ $project->title}}
                <div class="float-right d-flex">
                    @can('isAdmin')
                    <form action="{{ route('project.destroy',$project->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary mr-2" type="submit">Delete</button>
                    </form>
                    @endcan
                    @can('isEng')
                    <a class="btn btn-primary" href="{{ route('project.edit', $project->id) }}" role="button">Edit</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{$project->description}}</p>
            </div>
        </div>
    </a>
    @endforeach
    {{-- pagtionation --}}
    {{ $projects->links() }}
    @else

    <div class="alert alert-danger text-center" role="alert">
        there is no projects to Show.
    </div>
    @endif

</div>
@endsection
