<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\Content;

class PublishContent implements ShouldQueue
{
    use Queueable;

    protected int $contentId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $contentId)
    {
        $this->contentId = $contentId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $content = Content::findOrFail($this->contentId);
        $content->status = 'published';
        $content->published_at = now();
        $content->save();
    }
}
