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

    public function add_category(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|min:3|unique:categories,name',
            ]);

            $category = Category::create([
                'name' => $request->input('name'),
            ]);

            return response()->json(['id' => $category->id, 'name' => $category->name], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
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

    public function add_trend(Request $request)
    {

        try {
            $request->validate([
                'title' => 'required|string|min:3|max:255',
            ]);
            
            $trend = Trend::create([
                'title' => $request->input('title'),
            ]);

            return response()->json(['id' => $trend->id, 'title' => $trend->title], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
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

    public function add_window(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:255|min:3',
            ]);

            $window = Window::create([
                'name' => $request->input('name'),
            ]);

            return response()->json(['id' => $window->id, 'name' => $window->name], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
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

    public function add_tag(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|min:3|unique:tags,name',
            ]);

            $tag = Tag::create([
                'name' => $request->input('name'),
            ]);

            return response()->json(['id' => $tag->id, 'name' => $tag->name], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
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

    public function add_writer(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:150',
                'slug' => 'required|string|max:150|unique:writers',
                'bio' => 'required|string',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'facebook' => 'nullable|url',
                'x' => 'nullable|url',
                'instagram' => 'nullable|url',
                'linkedin' => 'nullable|url',
            ]);

            $writer = Writer::create($validated);

            
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('writers', 'public');
                $writer->image = $path;
                $writer->save();
            }

            return response()->json(['id' => $writer->id, 'name' => $writer->name], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
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
