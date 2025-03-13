<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model

{
    use hasFactory;

    protected $fillable = ['title', 'introduction', 'body', 'url', 'github', 'user_id', 'thumbnail', 'featured'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
