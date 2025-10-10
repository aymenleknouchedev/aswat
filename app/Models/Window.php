<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Window extends Model
{
    protected $fillable = ['name' , 'slug', 'image'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
