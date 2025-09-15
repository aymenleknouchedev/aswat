<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ContentMedia;


class Content extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'long_title',
        'mobile_title',
        'display_method',
        'section_id',
        'category_id',
        'continent_id',
        'country_id',
        'trend_id',
        'window_id',
        'writer_id',
        'city_id',
        'tag_id',
        'summary',
        'content',
        'seo_keyword',
        'content_type',
        'status',
        'template',
        'review_description',
        'share_description',
        'share_title',
        'share_image',

        // Normal Image
        'normal_main_image',
        'normal_mobile_image',
        'normal_content_image',

        // Video
        'video_main_image',
        'video_mobile_image',
        'video_content_image',
        'video_file',
        'video_url',

        // Podcast
        'podcast_main_image',
        'podcast_mobile_image',
        'podcast_content_image',
        'podcast_file',
        'podcast_url',

        // Album
        'album_main_image',
        'album_mobile_image',
        'album_content_image',
        'album_images',
        // No Image
        'no_image_content_image',
        'no_image_mobile_image',
    ];

    public function topContent()
    {
        return $this->hasOne(TopContent::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function media()
    {
        return $this->belongsToMany(
            ContentMedia::class,   // الموديل الآخر
            'media_content',       // اسم الجدول الوسيط (pivot)
            'content_id',          // FK للـ content
            'content_media_id'     // FK للـ media
        )->withPivot('type');      // 🔥 نجيب كولم type من pivot
    }

    public function social()
    {
        return $this->hasOne(ContentSocial::class);
    }
    public function reviews()
    {
        return $this->hasMany(ContentReview::class);
    }

    public function contentLists()
    {
        return $this->hasMany(ContentList::class);
    }
}
