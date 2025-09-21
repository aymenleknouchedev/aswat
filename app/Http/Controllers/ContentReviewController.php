<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\ContentReview;

class ContentReviewController extends Controller
{
    public function index($id)
    {
        $reviews = ContentReview::where('content_id', $id)->orderBy("created_at","asc")->get();
        return view("dashboard.contentreviews",compact("reviews", "id"));
    }

    public function getContentReviews($id) {
        try {
            $content = Content::findOrFail($id);
            $reviews = $content->reviews;
            return response()->json($reviews);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Content not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch reviews', 'details' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "content_id" => "required|exists:contents,id",
                "message" => "required|string",
            ]);

            $userId = Auth::id();
            $review = ContentReview::create([
                'reviewer_id' => $userId,
                'content_id' => $validated['content_id'],
                'message' => $validated['message'],
            ]);

            return response()->json(['review' => $review], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to submit review', 'details' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                "message" => "required|string",
            ]);

            $userId = Auth::id();
            $review = ContentReview::where('id', $id)->where('reviewer_id', $userId)->firstOrFail();
            $review->update([
                'message' => $validated['message'],
            ]);

            return response()->json(['message' => 'Review updated successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Review not found or access denied'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update review', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $userId = Auth::id();
            $review = ContentReview::where('id', $id)->where('reviewer_id', $userId)->firstOrFail();
            $review->delete();
            return response()->json(['message'=> 'Deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Review not found or access denied'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete review', 'details' => $e->getMessage()], 500);
        }
    }
}
