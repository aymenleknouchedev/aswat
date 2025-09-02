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
    public function index()
    {
        $windows = Window::all();
        return view('dashboard.allwindows', compact('windows'));
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $window = new Window();
        $window->name = $request->input('name');
        $window->save();

        return redirect()->route('dashboard.window.create')->with('success', 'Window created successfully.');
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
        //
    }
}
