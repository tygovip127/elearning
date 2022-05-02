<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderFileAttack extends Model
{
    use HasFactory;

    function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
