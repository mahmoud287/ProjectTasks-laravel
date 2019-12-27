<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required',
            'comment' => 'required',
        ]);
        Comment::create($request->all());
        return redirect()->route('task.show', $request->task_id);
    }
}
