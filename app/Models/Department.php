<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
    ];

    function activityClasses()
    {
        return $this->hasMany(ActivityClass::class);
    }

    function lecturers()
    {
        return $this->hasMany(Lecturer::class);
    }
}
