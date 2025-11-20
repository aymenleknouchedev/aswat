<?php

namespace App\Models;

use App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    protected $fillable = ['content_id', 'type', 'path', 'media_type', 'name', 'alt', 'user_id'];

    // 📌 في Model: ContentMedia
    public function contents()
    {
        return $this->belongsToMany(
            Content::class,
            'media_content',
            'content_media_id',   // FK للـ media
            'content_id'          // FK للـ content
        )->withPivot('type');      // 🔥 نجيب كولم type من pivot
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get badge color for media type
     */
    public function getTypeBadgeAttribute()
    {
        $badges = [
            'image' => 'primary',
            'video' => 'success',
            'voice' => 'info',
            'audio' => 'info',
            'document' => 'warning',
            'file' => 'secondary'
        ];

        return $badges[$this->type] ?? 'secondary';
    }

    /**
     * Get Arabic label for media type
     */
    public function getTypeLabelAttribute()
    {
        $labels = [
            'image' => 'صورة',
            'video' => 'فيديو',
            'voice' => 'صوت',
            'audio' => 'صوت',
            'document' => 'مستند',
            'file' => 'ملف'
        ];

        return $labels[$this->type] ?? $this->type;
    }

    /**
     * Get the full URL for the media file
     * This accessor ensures paths are properly converted to valid URLs
     */
    public function getUrlAttribute()
    {
        if (empty($this->path)) {
            return null;
        }

        // If it's already a full URL (external link), return as-is
        if (filter_var($this->path, FILTER_VALIDATE_URL)) {
            return $this->path;
        }

        // If it starts with /storage/, convert to asset URL
        if (str_starts_with($this->path, '/storage/')) {
            return asset($this->path);
        }

        // If it starts with storage/ (missing leading slash), add it
        if (str_starts_with($this->path, 'storage/')) {
            return asset('/' . $this->path);
        }

        // For any other path, use asset helper
        return asset($this->path);
    }
}
