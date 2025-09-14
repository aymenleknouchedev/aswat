<?php

namespace App\Models;

use App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    protected $fillable = ['content_id', 'type', 'path', 'media_type', 'name', 'alt' , 'user_id'];

    // 📌 في Model: ContentMedia
    public function contents()
    {
        return $this->belongsToMany(
            Content::class,
            'media_content',
            'content_media_id',   // FK للـ media
            'content_id'          // FK للـ content
        )->withPivot('type');      // 🔥 نجيب كولم type من pivot
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
