<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Content;

class PublishContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:publish {content_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish a specific content by its ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contentId = $this->argument('content_id');

        $content = Content::findOrFail($contentId);
        if ($content) {
            if ($content->status === 'published') {
                $this->info("Content with ID {$contentId} is already published.");
            }
    
            $content->status = 'published';
            $content->published_at = now();
            $content->save();
    
            $this->info("Content with ID {$contentId} has been published successfully at " . $content->published_at);
        } else {
            $this->error("Content with ID {$contentId} not found.");
        }
        return 0;
    }
}
