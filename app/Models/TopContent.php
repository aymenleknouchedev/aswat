<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TopContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'order',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
