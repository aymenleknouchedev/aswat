<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisplayMethod extends Model
{
    protected $fillable = ['name', 'description'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
