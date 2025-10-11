<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WindowManagement extends Model
{
    protected $fillable = [
        'section_id',
        'window_id',
        'status',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function window()
    {
        return $this->belongsTo(Window::class);
    }
}
