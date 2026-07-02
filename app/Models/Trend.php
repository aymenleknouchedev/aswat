<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    protected $fillable = ['title', 'slug', 'image', 'social_image', 'description'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
