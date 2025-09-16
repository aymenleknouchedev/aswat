<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Trend;
use App\Models\Window;
use App\Models\Writer;
use App\Models\Tag;
use App\Models\Location;

class ApiController extends Controller
{
    public function search_categories(Request $request)
    {
        try {
            $query = $request->query('search', '');

            $categories = Category::where('name', 'LIKE', "%$query%")
            ->get(['id', 'name']);

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    public function search_trends(Request $request)
    {
        try {
            $query = $request->query('search', '');

            $trends = Trend::where('title', 'LIKE', "%$query%")
                ->get(['id', 'title']);

            return response()->json($trends);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    public function search_windows(Request $request)
    {
        try {
            $query = $request->query('search', '');

            $windows = Window::where('name', 'LIKE', "%$query%")
                ->get(['id', 'name']);

            return response()->json($windows);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    public function search_tags(Request $request)
    {
        try {
            $query = $request->query('search', '');

            $tags = Tag::where('name', 'LIKE', "%$query%")
                ->get(['id', 'name']);

            return response()->json($tags);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    public function search_writers(Request $request)
    {
        try {
            $query = $request->query('search', '');

            $writers = Writer::where('name', 'LIKE', "%$query%")
                ->get(['id', 'name']);

            return response()->json($writers);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    public function search_cities(Request $request)
    {
        try {
            $query = $request->query('search', '');

            $cities = Location::where('name', 'LIKE', "%$query%")
                ->where('type', 'city')
                ->get(['id', 'name']);

            return response()->json($cities);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
}
