<?php

namespace App\Http\Controllers;

use App\SubTask;
use App\Task;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    public function create(Request $request)
    {
        $this->authorize('isAdmin');
        $this->authorize('create', [Task::findOrFail($request->input('task_id'))->project]);
        return View('subTask.create');
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
            'task_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        SubTask::create($request->all());
        return redirect()->route('task.show', $request->task_id)->with('success', 'Sub Task created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubTask $subTask)
    {
        $this->authorize('isEng');
        $this->authorize('view', $subTask->task);
        return view('subTask.edit', compact('subTask'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubTask $subTask)
    {
        $this->authorize('isEng');
        $request->validate([
            'task_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        $subTask->update($request->all());
        return redirect()->route('task.show', $subTask->task_id)->with('success', 'Task Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubTask $subTask)
    {
        $this->authorize('isAdmin');
        $subTask->delete();
        return redirect()->route('task.show', $subTask->task_id)->with('success', 'Task Deleted successfully.');
    }
}
