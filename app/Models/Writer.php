<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $fillable = ['name', 'email'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
