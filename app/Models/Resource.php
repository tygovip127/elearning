<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'topic_id',
        'title',
        'description',
        'resource_type',
    ];

    function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    function url()
    {
        return $this->hasOne(Url::class, 'id');
    }

    function files()
    {
        return $this->hasMany(File::class);
    }

    function assignment()
    {
        return $this->hasOne(Assignment::class, 'id');
    }

    function folderFileAttacks()
    {
        return $this->hasMany(FolderFileAttack::class);
    }
}
