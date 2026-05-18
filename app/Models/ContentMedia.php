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

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }

    public function trend()
    {
        return $this->belongsTo(Trend::class);
    }

    public function window()
    {
        return $this->belongsTo(Window::class);
    }


    

    /**
     * Is this media referenced anywhere? (pivot, article body, share image)
     * Used to decide whether the delete button is enabled.
     */
    public function isReferenced(): bool
    {
        if ($this->contents()->exists()) {
            return true;
        }

        $needle = $this->path;
        if (empty($needle)) {
            return false;
        }

        // Match the bare path (without scheme/host) too, so both relative and
        // absolute embeds count as a reference.
        $candidates = collect([$needle]);
        $parsed = parse_url($needle, PHP_URL_PATH);
        if ($parsed) {
            $candidates->push($parsed);
        }

        return Content::query()
            ->where(function ($q) use ($candidates) {
                foreach ($candidates as $c) {
                    $like = '%' . addcslashes($c, '\\%_') . '%';
                    $q->orWhere('content', 'like', $like)
                      ->orWhere('share_image', 'like', $like);
                }
            })
            ->exists();
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
