<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $subTasks = $task->subTasks()->paginate(2);
        $comments = $task->comments()->paginate(2);
        return View('task.show', compact('task', 'subTasks', 'comments'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('isAdmin');
        $this->authorize('create', [Project::findOrFail($request->input('project_id'))]);
        return View('task.create');
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
            'project_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        Task::create($request->all());
        return redirect()->route('project.show', $request->project_id)->with('success', 'Task created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('isEng');
        $this->authorize('view', $task);
        return view('task.edit', compact('task'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('isEng');
        $request->validate([
            'project_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        $task->update($request->all());
        return redirect()->route('project.show', $task->project_id)->with('success', 'Task Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('isAdmin');
        $task->delete();
        return redirect()->route('project.show', $task->project_id)
            ->with('success', 'Task deleted successfully');

    }
}
