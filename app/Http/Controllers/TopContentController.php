<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\TopContent;
use App\Models\Content;
use Illuminate\Http\Request;

class TopContentController extends Controller
{
    public function index()
    {
        try {
            $sections = Section::all();

            // Get top contents (ordered)
            $topContents = TopContent::with('content')
                ->orderBy('order', 'desc')
                ->get();

            // Load recent contents with section data — don't exclude any (since we now just disable them in UI)
            $recentContents = Content::with('section')
                ->orderBy('created_at', 'desc')
                ->take(200)
                ->get();

            return view("dashboard.topcontents", compact("topContents", "sections", "recentContents"));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to retrieve content']);
        }
    }

    /**
     * Search/filter contents for top contents page
     */
    public function searchContents(Request $request)
    {
        try {
            $query = Content::with('section');

            // Filter by search term (title or ID)
            if ($request->filled('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('id', 'LIKE', "%{$searchTerm}%");
                });
            }

            // Filter by section
            if ($request->filled('section_id')) {
                $query->where('section_id', $request->input('section_id'));
            }

            $contents = $query->orderBy('created_at', 'desc')
                ->take(200)
                ->get();

            return response()->json([
                'success' => true,
                'contents' => $contents->map(function ($content) {
                    return [
                        'id' => $content->id,
                        'title' => $content->title,
                        'section_id' => $content->section_id ?? '',
                        'section_name' => $content->section->name ?? '',
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

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
                    'message' => app()->getLocale() === 'en'
                        ? 'You must have at least 7 top contents.'
                        : 'يجب أن يكون لديك 7 محتويات على الأقل.',
                    'message_ar' => 'يجب أن يكون لديك 7 محتويات على الأقل.',
                    'message_en' => 'You must have at least 7 top contents.',
                ], 422);
            }

            // 🛑 Enforce max 15 contents rule
            if (count($ids) > 15) {
                return response()->json([
                    'success' => false,
                    'error' => 'Too many items',
                    'message' => app()->getLocale() === 'en'
                        ? 'You can only have up to 15 top contents.'
                        : 'يمكنك إضافة 15 محتوى فقط كحد أقصى.',
                    'message_ar' => 'يمكنك إضافة 15 محتوى فقط كحد أقصى.',
                    'message_en' => 'You can only have up to 15 top contents.',
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
