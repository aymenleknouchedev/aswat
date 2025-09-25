<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Http\Controllers\Controller;
use App\Models\TopContent;
use App\Models\Content;
use Illuminate\Http\Request;

class TopContentController extends Controller
{
    public function index()
    {
        try {
            $sections = Section::all();
            // $topContents = TopContent::with("content")->get();
            $topContents = TopContent::with('content')
                ->orderBy('order', 'desc')
                ->get()
                ->pluck('content.title', 'id')
                ->toArray();

            
            $existingContentIds = TopContent::pluck('content_id')->toArray();

            $recentContents = Content::whereNotIn('id', $existingContentIds)
                ->orderBy('created_at', 'desc')
                ->take(30)
                ->get();

                return view("dashboard.topcontents", compact("topContents", "sections", "recentContents"));
        } catch (\Exception $e) {
            // Handle exception
            return back()->withErrors(['error' => 'Failed to retrieve content']);
        }
    }

    public function store($id)
    {
        try {
            // Check if content already exists in top contents
            $existing = TopContent::where('content_id', $id)->first();
            if ($existing) {
                return response()->json(['error'=> 'Content already exists in top contents'], 400);
            }

            $count = TopContent::count();
            // max TopContent is 10 cant be more
            if ($count >= 10) {
                return response()->json(['error' => 'Maximum of 10 top contents allowed'], 400);
            }

            $topContent = new TopContent();
            $topContent->content_id = $id;
            $topContent->order = (TopContent::max('order') ?? 0) + 1;
            $topContent->save();

            return response()->json([
                'success' => true,
                'content' => [
                    'id' => $topContent->id,
                    'title' => $topContent->content->title,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add content to top contents'], 500);
        }
    }

    public function updateOrder(Request $request)
    {
        try {
            $ids = $request->input('ids', []); 

            foreach ($ids as $index => $id) {
                TopContent::where('id', $id)->update([
                    'order' => count($ids) - $index 
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to update order'], 500);
    }
}


    public function destroy($id)
    {
        try {
            $content = TopContent::find($id);
            if ($content) {
                $content->delete();
            } else {
                return response()->json(['error' => 'Top Content not found', 'success' => false], 404);
            }
             return response()->json([
                'success' => true,
                'message' => 'Content removed successfully',
                'id' => $id,
            ]);
        } catch (\Exception $e) {
             return response()->json([
                'success' => false,
                'message' => 'Failed to remove content',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
