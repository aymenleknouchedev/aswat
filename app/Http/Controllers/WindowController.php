<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Window;

class WindowController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:windows_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Window::query();
            $pagination = config('pagination.per20', 20);
            if ($search = $request->input('search')) {
                $query->where('name', 'LIKE', "%{$search}%");
            }

            if (!$search) {
                $windows = Window::paginate($pagination)
                           ->appends($request->all());
            } else {
                $windows = $query->orderBy('id', 'desc')
                                    ->paginate($pagination)
                                    ->appends($request->all());
            }
            
            return view('dashboard.allwindows', compact('windows'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to load windows: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addwindow');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:windows,name',
            ]);

            $window = new Window();
            $window->name = $request->input('name');
            $window->save();

            return redirect()->back()->with('success', 'Window created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to create window: ' . $e->getMessage());
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
        $window = Window::findOrFail($id);
        return view('dashboard.editwindow', compact('window'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $window = Window::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $window->name = $request->input('name');
            $window->save();

            return redirect()->back()->with('success', 'Window updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to update window: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $window = Window::findOrFail($id);
            $window->delete();

            return redirect()->back()->with('success', 'Window deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to delete window: ' . $e->getMessage());
        }
    }
}
