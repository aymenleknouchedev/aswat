<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\TopContent;
use App\Models\Content;
use App\Models\Trend;
use Illuminate\Http\Request;

class TopContentController extends Controller
{
    public function index()
    {
        try {
            $sections = Section::all();
            $latestTrendContents = collect(); // Use collection instead of array

            $trend = Trend::latest()->first();
            if ($trend) {
                $trendlist = $trend->contents()
                    ->latest()
                    ->take(4)
                    ->get();
                $latestTrendContents = $trendlist; // Assign collection directly
            }

            // Get top contents (ordered by 'order' ascending - not descending)
            $topContents = TopContent::with('content')
                ->orderBy('order', 'asc') // Changed from 'desc' to 'asc'
                ->get();

            // Load recent contents
            $recentContents = Content::orderBy('created_at', 'desc')
                ->take(50)
                ->get();

            return view("dashboard.topcontents", compact("topContents", "sections", "recentContents", "latestTrendContents"));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to retrieve content: ' . $e->getMessage()]);
        }
    }

    // Optional: Add this method to fix order if there are issues with the database
    // public function fixOrderSequence()
    // {
    //     try {
    //         $topContents = TopContent::orderBy('order', 'asc')->get();

    //         foreach ($topContents as $index => $item) {
    //             $item->update(['order' => $index + 1]);
    //         }

    //         return response()->json(['success' => true, 'message' => 'Order sequence fixed']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }

    /**
     * Save or update top contents order and selection.
     * Expected payload: { ids: [content_id1, content_id2, ...] }
     */
    public function updateOrder(Request $request)
    {
        try {
            $ids = $request->input('ids', []);

            // if ids are less than 7 return error
            if (count($ids) < 7) {
                return response()->json([
                    'success' => false,
                    'error' => 'Not enough items',
                    'message' => 'You must have at least 7 top contents.',
                ], 422);
            }

            // 🛑 Enforce max 15 contents rule
            if (count($ids) > 15) {
                return response()->json([
                    'success' => false,
                    'error' => 'Too many items',
                    'message' => 'You can only have up to 15 top contents.',
                ], 422);
            }

            // If no IDs, clear all top contents
            if (empty($ids)) {
                TopContent::truncate();
                return response()->json(['success' => true, 'message' => 'List cleared']);
            }

            // Remove old contents not in the new list
            TopContent::whereNotIn('content_id', $ids)->delete();

            // Reorder or create new ones (reverse to keep top order consistent)
            foreach (array_reverse($ids) as $index => $contentId) {
                TopContent::updateOrCreate(
                    ['content_id' => $contentId],
                    ['order' => $index + 1]
                );
            }

            return response()->json(['success' => true, 'message' => 'Order saved successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to update order',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
