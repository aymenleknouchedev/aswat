<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    protected $fillable = ['content_id', 'media_type', 'url'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
