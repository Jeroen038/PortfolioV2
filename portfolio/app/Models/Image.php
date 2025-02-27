<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'description', 'alt', 'images_src', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
