<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'content_tag');
    }
    
}
