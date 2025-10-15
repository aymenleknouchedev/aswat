<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentDailyView extends Model
{
    protected $fillable = ['content_id', 'date', 'views'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
