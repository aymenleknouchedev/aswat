<?php

namespace App\Models;

use App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    protected $fillable = ['content_id', 'type', 'path', 'media_type'];

    public function contents()
    {
        return $this->belongsToMany(
            Content::class,
            'media_content',
            'content_media_id',   // FK للـ media
            'content_id'          // FK للـ content
        );
    }
}
