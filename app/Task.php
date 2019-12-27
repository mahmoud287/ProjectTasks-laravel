<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'project_id'];

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
