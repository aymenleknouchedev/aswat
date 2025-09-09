<?php

namespace App\Models;

use App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    protected $fillable = ['content_id', 'type', 'path'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
