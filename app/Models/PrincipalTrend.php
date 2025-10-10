<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrincipalTrend extends Model
{
    protected $fillable = ['trend_id'];


    public function trend()
    {
        return $this->belongsTo(Trend::class, 'trend_id');
    }
}
