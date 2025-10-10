<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrincipalTrend;

class PrincipalTrendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all trends
        $allTrends = \App\Models\Trend::all();
        // Assuming you have a PrincipalTrend model
        $principalTrend = \App\Models\PrincipalTrend::find(1);
        return view('dashboard.principal_trend', compact('principalTrend', 'allTrends'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $request->validate([
            'trend_id' => 'required|exists:trends,id',
        ]);

        // Delete all principal trends
        PrincipalTrend::truncate();

        // Create a new principal trend with id = 1
        $principalTrend = new PrincipalTrend();
        $principalTrend->id = 1;
        $principalTrend->trend_id = $request->trend_id;
        $principalTrend->is_active = $request->has('is_active');
        $principalTrend->save();

        return redirect()->back()->with('success', 'تم تحديث الترند الرئيسي بنجاح');
    }

    public function destroy(string $id)
    {
        //
    }
}
