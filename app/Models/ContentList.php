<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Content;

class ContentList extends Model
{
    /** @use HasFactory<\Database\Factories\ContentListFactory> */
    use HasFactory;

    protected $fillable = [
        'content_id',
        'title',
        'description',
        'image',
        'url',
        'index',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
