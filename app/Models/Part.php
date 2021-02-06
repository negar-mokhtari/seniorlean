<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'parts';

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
