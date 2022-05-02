<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentFileAttack extends Model
{
    use HasFactory;

    function assignments()
    {
        return $this->belongsTo(Assignment::class);
    }
}
