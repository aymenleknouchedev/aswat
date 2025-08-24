<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreakingContent extends Model
{
    protected $fillable = ['text', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
