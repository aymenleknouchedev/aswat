<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadMore extends Model
{
    use HasFactory;

    protected $table = 'read_mores';

    protected $fillable = [
        'content_id',
        'section_id',
        'status',
        'order',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the content that this ReadMore references
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    /**
     * Get the section/category that this ReadMore belongs to
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'section_id');
    }

    /**
     * Scope to filter by section
     */
    public function scopeBySection($query, $sectionId)
    {
        if ($sectionId) {
            return $query->where('section_id', $sectionId);
        }
        return $query;
    }

    /**
     * Scope to get only active ReadMore content
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->whereHas('content', function ($q) {
                $q->where('status', 'published');
            });
    }

    /**
     * Scope to order by custom order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get ReadMore content with full details
     */
    public static function getContentData($contentId)
    {
        $content = Content::with([
            'media' => function ($q) {
                $q->wherePivot('type', 'main');
            },
            'category'
        ])
        ->select(['id', 'title', 'summary', 'created_at', 'category_id', 'shortlink'])
        ->where('status', 'published')
        ->find($contentId);

        if (!$content) {
            return null;
        }

        $mainImage = $content->media()->wherePivot('type', 'main')->first();
        $imagePath = $mainImage ? $mainImage->path : null;

        if ($imagePath && !str_starts_with($imagePath, 'http')) {
            $imagePath = url($imagePath);
        }

        return [
            'id' => $content->id,
            'title' => $content->title ?? 'Untitled',
            'category' => $content->category->name ?? null,
            'image_url' => $imagePath,
            'summary' => \Illuminate\Support\Str::limit($content->summary ?? '', 150),
            'link' => url('/news/' . urlencode($content->title)),
            'shortlink' => $content->shortlink ?? null,
            'created_at' => $content->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Get multiple ReadMore content data by IDs
     */
    public static function getMultipleContentData(array $contentIds)
    {
        $contents = Content::with([
            'media' => function ($q) {
                $q->wherePivot('type', 'main');
            },
            'category'
        ])
        ->select(['id', 'title', 'summary', 'created_at', 'category_id', 'shortlink'])
        ->where('status', 'published')
        ->whereIn('id', $contentIds)
        ->get();

        return $contents->map(function ($content) {
            $mainImage = $content->media()->wherePivot('type', 'main')->first();
            $imagePath = $mainImage ? $mainImage->path : null;

            if ($imagePath && !str_starts_with($imagePath, 'http')) {
                $imagePath = url($imagePath);
            }

            return [
                'id' => $content->id,
                'title' => $content->title ?? 'Untitled',
                'category' => $content->category->name ?? null,
                'image_url' => $imagePath,
                'summary' => \Illuminate\Support\Str::limit($content->summary ?? '', 150),
                'link' => url('/news/' . urlencode($content->title)),
                'shortlink' => $content->shortlink ?? null,
                'created_at' => $content->created_at->format('Y-m-d H:i:s'),
            ];
        })->keyBy('id');
    }
}
