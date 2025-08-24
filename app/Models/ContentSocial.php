<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSocial extends Model
{
    protected $fillable = ['content_id', 'title', 'description', 'image'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
