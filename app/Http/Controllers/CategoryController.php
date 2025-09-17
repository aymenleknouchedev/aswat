<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:categories_access']);
    }
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        try {
            $pagination = config('pagination.per20', 20);

            $query = Category::query();

            if ($search = $request->input('search')) {
                $query->where('name', 'LIKE', "%{$search}%");
            }

            $categories = $query->latest()->paginate($pagination)
                                ->appends($request->all());

            return view('dashboard.allcategories', compact('categories'));
        } catch (\Throwable $e) {
            return redirect()
                ->route('dashboard.categories.index')
                ->withErrors(['error' => 'فشل تحميل التصنيفات. حاول مرة أخرى.']);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new category
        return view('dashboard.addcategory');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'name' => 'required|string|min:3|max:255|unique:categories,name',
            ])->validate();

            Category::create([
                'name' => $request->input('name'),
            ]);

            return redirect()->back()->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create category.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.editcategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);

            Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ])->validate();

            $category->update([
                'name' => $request->input('name'),
            ]);

            return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update category.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete category.']);
        }
    }
}
