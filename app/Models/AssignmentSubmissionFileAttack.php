<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmissionFileAttack extends Model
{
    use HasFactory;

    function assignmentSubmission()
    {
        return $this->belongsTo(AssignmentSubmission::class);
    }
}
