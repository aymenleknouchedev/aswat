<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function windowManagement()
    {
        return $this->hasOne(WindowManagement::class);
    }
}
