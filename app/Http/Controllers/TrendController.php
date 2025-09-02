<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Trend;

class TrendController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:trends_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.alltrends');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addtrend');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $trend = new Trend();
        $trend->title = $request->input('title');
        $trend->save();

        return redirect()->route('dashboard.trend.create')->with('success', 'Trend created successfully.');
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
