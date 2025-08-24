<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'long_title',
        'mobile_title',
        'display_method',
        'section_id',
        'category_id',
        'location_id',
        'trend_id',
        'window_id',
        'writer_id',
        'writer_location_id',
        'summary',
        'body',
        'seo_keyword',
        'content_type',
        'status'
    ];

    public function topContent()
    {
        return $this->hasOne(TopContent::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function displayMethod()
    {
        return $this->belongsTo(DisplayMethod::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function trend()
    {
        return $this->belongsTo(Trend::class);
    }
    public function window()
    {
        return $this->belongsTo(Window::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'content_tag');
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }
    public function writerLocation()
    {
        return $this->belongsTo(Location::class, 'writer_location_id');
    }

    public function images()
    {
        return $this->hasMany(ContentImage::class);
    }
    public function media()
    {
        return $this->hasMany(ContentMedia::class);
    }
    public function social()
    {
        return $this->hasOne(ContentSocial::class);
    }
    public function reviews()
    {
        return $this->hasMany(ContentReview::class);
    }
}
