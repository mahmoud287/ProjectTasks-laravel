<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $projects = $user->projects()->paginate(2);
        return View('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');
        $users_list = User::all();
        return View('project.create', compact('users_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        Project::create($request->all());
        return redirect('/project')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        $this->authorize('view', $project);
        $tasks = $project->tasks()->paginate(2);
        return View('project.show', compact('project', 'tasks'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('isEng');
        $this->authorize('view', $project);
        $users_list = User::all();
        return view('project.edit', compact('project', 'users_list'));
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('isEng');
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        $project->update($request->all());
        return redirect('/project')->with('success', 'Project Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('isAdmin');
        $project->delete();
        return redirect()->route('project.index')
            ->with('success', 'Project deleted successfully');

    }
}
