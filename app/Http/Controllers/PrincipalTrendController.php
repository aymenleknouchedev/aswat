<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrincipalTrend;
use App\Models\Trend;

class PrincipalTrendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $principalTrend = PrincipalTrend::first();
        $allTrends = Trend::all();

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
            'is_active' => 'required|boolean',
        ]);

        $principalTrend = PrincipalTrend::first();
        if (!$principalTrend) {
            $principalTrend = new PrincipalTrend();
        }

        $principalTrend->trend_id = $request->trend_id;
        $principalTrend->is_active = $request->is_active;
        $principalTrend->save();

        return redirect()->back()->with('success', 'تم تحديث الترند الرئيسي بنجاح');
    }

    public function destroy(string $id)
    {
        //
    }
}
