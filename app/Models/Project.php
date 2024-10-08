<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'assigned_to');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
