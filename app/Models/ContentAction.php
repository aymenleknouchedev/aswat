<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentAction extends Model
{
    protected $fillable = [
        'content_id',
        'action_type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

}
