<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ContentMedia;
use App\Models\Category;
use App\Models\Trend;
use App\Models\Window;
use App\Models\Tag;
use App\Models\Writer;


class Content extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'caption',
        'user_id',
        'updated_by_user_id',
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
        'created_at_by_admin',
        'shortlink',
        'published_at',
        'published_date',

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

        // Additional Fields
        'is_latest',
        'importance',
        'shortlink'
    ];

    public function topContent()
    {
        return $this->hasOne(TopContent::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
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

    public function continent()
    {
        return $this->belongsTo(Location::class, 'continent_id');
    }

    public function country()
    {
        return $this->belongsTo(Location::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(Location::class, 'city_id');
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

    public function contentActions()
    {
        return $this->hasMany(ContentAction::class);
    }

    public function contentDailyViews()
    {
        return $this->hasMany(ContentDailyView::class);
    }

    public function writers()
    {
        return $this->belongsToMany(Writer::class, 'content_writer')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'content_writer')
            ->withPivot('role')
            ->withTimestamps();
    }
}
