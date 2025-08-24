<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name'];

    public function contents()
    {
        return $this->hasMany(Content::class, 'location_id');
    }

    public function writerContents()
    {
        return $this->hasMany(Content::class, 'writer_location_id');
    }
}
