<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $fillable = ['title', 'description', 'task_id'];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
