<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'course_id',
    ];

    function resources()
    {
        return $this->hasMany(Resource::class);
    }

    function course()
    {
        return $this->belongsTo(Course::class);
    }
}
