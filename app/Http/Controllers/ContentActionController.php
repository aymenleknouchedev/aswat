<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentActionController extends Controller
{
    public function content_actions($contentId)
    {
        $content = Content::findOrFail($contentId);
        $contentActions = $content->contentActions;
        
        return view('dashboard.allcontentactions', compact('content', 'contentActions'));
    }
}
