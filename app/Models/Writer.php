<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'bio',
        'image',      // لو خزن صورة واحدة
        // 'images',   // لو حابب تخزن صور متعددة كـ JSON
        'facebook',
        'x',
        'instagram',
        'linkedin',
    ];
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
