<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentReview extends Model
{
    protected $fillable = ['content_id', 'message', 'reviewer_id'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
