<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded;

    protected $table = 'lessons';

    public function quizzes()
    {
        return $this->hasMany('App\Models\Quiz');
    }
}
