<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class WritterController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'check:writers_access']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = Writer::query();
            $pagination = config('pagination.per20', 20);

            if ($search = request()->input('search')) {
                $query->where('name', 'LIKE', "%{$search}%");
            }

            if (!$search) {
                $writers = Writer::paginate($pagination)
                           ->appends(request()->all());
            } else {
                $writers = $query->orderBy('id', 'desc')
                                    ->paginate($pagination)
                                    ->appends(request()->all());
            }

            return view('dashboard.allwritters', compact('writers'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to load writers: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addwritter');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:150|unique:writers,name',
                'slug' => 'required|string|max:150',
                'bio' => 'required|string',
                'image.*' => 'required',
                'facebook' => 'nullable|url',
                'x' => 'nullable|url',
                'instagram' => 'nullable|url',
                'linkedin' => 'nullable|url',
            ]);

            $writer = Writer::create($validated);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('writers', 'public');
                $path = asset('storage/' . $path);
                $writer->image = $path;
                $writer->save();
            }

            return redirect()->route('dashboard.writer.create')->with('success', 'Writer added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to add writer: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $writer = Writer::findOrFail($id);
        return view('dashboard.editwritter', compact('writer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $writer = Writer::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:150',
                'slug' => 'required|string|max:150|unique:writers,slug,' . $writer->id,
                'bio' => 'required|string',
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'facebook' => 'nullable|url',
                'x' => 'nullable|url',
                'instagram' => 'nullable|url',
                'linkedin' => 'nullable|url',
            ]);

            $writer->update($validated);

           
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('writers', 'public');
                $path = asset('storage/' . $path);
                $writer->image = $path;
                $writer->save();
            }

            return redirect()->route('dashboard.writers.index')->with('success', 'Writer updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to update writer: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $writer = Writer::findOrFail($id);
            $writer->delete();

            return redirect()->route('dashboard.writers.index')->with('success', 'Writer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to delete writer: ' . $e->getMessage());
        }
    }
}
