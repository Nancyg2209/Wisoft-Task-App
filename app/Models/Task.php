<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'user_id', 'task_title', 'duedate'];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function center()
    {
        return $this->belongsTo('App\Models\Center');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}