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
        $writers = Writer::all();
        return view('dashboard.allwritters', compact('writers'));
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
        }

        return redirect()->route('dashboard.writer.create')->with('success', 'Writer added successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $writer = Writer::findOrFail($id);
        $writer->delete();

        return redirect()->route('dashboard.writers.index')->with('success', 'Writer deleted successfully.');
    }
}
