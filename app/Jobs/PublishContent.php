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
     * 
     * This job publishes scheduled content.
     * It preserves the originally scheduled published_at time
     * and sets published_date when automatically publishing.
     */
    public function handle(): void
    {
        $content = Content::findOrFail($this->contentId);
        
        // Only publish if still in scheduled status
        if ($content->status !== 'scheduled') {
            return;
        }
        
        // Update status to published, preserving the scheduled time
        $content->status = 'published';
        // Set published_date to the scheduled time (first publication)
        $content->published_date = $content->published_at;
        // Note: Do NOT overwrite published_at - keep the originally scheduled time
        $content->save();
    }
}
