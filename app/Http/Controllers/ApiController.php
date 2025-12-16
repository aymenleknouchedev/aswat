<?php

namespace App\Http\Controllers;

use App\Models\TopContent;
use App\Models\Category;
use App\Models\Trend;
use App\Models\Window;
use App\Models\Writer;
use App\Models\Tag;
use App\Models\Location;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    // ========== CONTENT RELATED METHODS ==========

    /**
     * Search contents with optional section filter
     */
    public function search_contents(Request $request)
    {
        try {
            $query = $request->query('search_all', '');
            $sq = $request->query('section_filter', null);

            $existingContentIds = TopContent::pluck('content_id')->toArray();

            $contents = Content::query()
                ->where('status', 'published')
                ->whereNotIn('id', $existingContentIds);

            if (!empty($sq)) {
                $contents->where('section_id', $sq);
            }

            if (!empty($query)) {
                $contents->where(function ($q2) use ($query) {
                    $q2->where('title', 'LIKE', "%$query%")
                        ->orWhere('long_title', 'LIKE', "%$query%");
                });
            }

            $results = $contents->orderBy('created_at', 'desc')
                ->take(30)
                ->get(['id', 'title']);

            return response()->json($results, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }


    /**
     * Add a new city
     */
    public function add_city(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|min:2|unique:locations,name',
                'slug' => 'required|string|max:255|min:2|unique:locations,slug',
                'type' => 'required|in:city',
            ]);

            $normalizedSlug = Str::slug($validated['slug']);
            if ($normalizedSlug !== $validated['slug'] && Location::where('slug', $normalizedSlug)->exists()) {
                throw ValidationException::withMessages([
                    'slug' => ['The slug has been normalized and now conflicts with an existing one. Please choose another.'],
                ]);
            }
            $slug = $normalizedSlug;

            $location = Location::create([
                'name' => $validated['name'],
                'slug' => $slug,
                'type' => $validated['type'],
            ]);

            return response()->json([
                'id'      => $location->id,
                'name'    => $location->name,
                'slug'    => $location->slug,
                'type'    => $location->type,
                'message' => 'Location created successfully.',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error'    => 'Validation Error',
                'messages' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    // ========== CATEGORY RELATED METHODS ==========

    /**
     * Search categories by name
     */
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

    /**
     * Add a new category
     */
    public function add_category(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|min:3|unique:categories,name',
                'slug' => 'required|string|max:255|min:3|unique:categories,slug',
            ]);

            $category = Category::create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);

            return response()->json(['id' => $category->id, 'name' => $category->name, 'slug' => $category->slug], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    // ========== TREND RELATED METHODS ==========

    /**
     * Search trends by title
     */
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

    /**
     * Add a new trend
     */
    public function add_trend(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|min:3|max:255|unique:trends,title',
                'slug'  => 'required|string|min:3|max:255|unique:trends,slug',
                'image' => 'required|image|mimes:jpeg,png,webp,gif|max:6144',
            ]);

            $normalizedSlug = Str::slug($validated['slug']);
            if ($normalizedSlug !== $validated['slug']) {
                if (Trend::where('slug', $normalizedSlug)->exists()) {
                    throw ValidationException::withMessages([
                        'slug' => ['The slug has been normalized and now conflicts with an existing one. Please choose another.'],
                    ]);
                }
            }
            $slug = $normalizedSlug;

            $path = $request->file('image')->store('trends', 'public');
            $imageUrl = asset('storage/' . $path);

            $trend = Trend::create([
                'title'      => $validated['title'],
                'slug'       => $slug,
                'image'     => $path,
            ]);

            return response()->json([
                'id'        => $trend->id,
                'title'     => $trend->title,
                'slug'      => $trend->slug,
                'image_url' => $imageUrl,
                'message'   => 'Trend created successfully.',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error'    => 'Validation Error',
                'messages' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'error'   => 'Server Error',
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }

    // ========== WINDOW RELATED METHODS ==========

    /**
     * Search windows by name
     */
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

    /**
     * Add a new window
     */
    public function add_window(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'  => 'required|string|max:255|unique:windows,name',
                'slug'  => 'required|string|max:255|unique:windows,slug',
                'image' => 'required|image|mimes:jpeg,png,webp,gif|max:6000',
            ]);

            $window = new Window();
            $window->name = $validated['name'];
            $window->slug = $validated['slug'];

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('media', 'public');
                $window->image = $path;
                $imageUrl = asset('storage/' . $path);
            } else {
                $imageUrl = null;
            }

            $window->save();

            return response()->json([
                'id'        => $window->id,
                'name'      => $window->name,
                'slug'      => $window->slug,
                'image_url' => $imageUrl,
                'message'   => 'Window created successfully.',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    // ========== TAG RELATED METHODS ==========

    /**
     * Search tags by name
     */
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

    /**
     * Add a new tag
     */
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

    // ========== WRITER RELATED METHODS ==========

    /**
     * Search writers by name
     */
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

    /**
     * Add a new writer
     */
    public function add_writer(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'      => 'required|string|max:150|unique:writers,name',
                'slug'      => 'required|string|max:150|unique:writers,slug',
                'bio'       => 'required|string',
                'image'     => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'facebook'  => 'nullable|url',
                'x'         => 'nullable|url',
                'instagram' => 'nullable|url',
                'linkedin'  => 'nullable|url',
                'email'     => 'nullable|email|max:190',
            ]);

            $normalizedSlug = Str::slug($validated['slug']);
            if ($normalizedSlug !== $validated['slug'] && Writer::where('slug', $normalizedSlug)->exists()) {
                throw ValidationException::withMessages([
                    'slug' => ['The slug has been normalized and now conflicts with an existing one. Please choose another.'],
                ]);
            }
            $slug = $normalizedSlug;

            $path = $request->file('image')->store('writers', 'public');
            $imageUrl = asset('storage/' . $path);

            $writer = Writer::create([
                'name'       => $validated['name'],
                'slug'       => $slug,
                'bio'        => $validated['bio'],
                'image_path' => $path,
                'facebook'   => $validated['facebook']  ?? null,
                'x'          => $validated['x']         ?? null,
                'instagram'  => $validated['instagram'] ?? null,
                'linkedin'   => $validated['linkedin']  ?? null,
                'email'      => $validated['email']     ?? null,
            ]);

            return response()->json([
                'id'        => $writer->id,
                'name'      => $writer->name,
                'slug'      => $writer->slug,
                'image_url' => $imageUrl,
                'message'   => 'Writer created successfully.',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    // ========== LOCATION RELATED METHODS ==========

    /**
     * Search cities by name
     */
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
