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
    public function index(Request $request)
    {
        try {
            $query = Trend::query();
            $pagination = config('pagination.per20', 20);

            if ($search = $request->input('search')) {
                $query->where('title', 'LIKE', "%{$search}%");
            }

            if (!$search) {
                $trends = Trend::paginate($pagination)
                           ->appends($request->all());
            } else {
                $trends = $query->orderBy('id', 'desc')
                                    ->paginate($pagination)
                                    ->appends($request->all());
            }
            
            return view('dashboard.alltrends', compact('trends'));
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'فشل تحميل الترندات. حاول مرة أخرى.']);
        }
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
        try {
            $request->validate([
                'title' => 'required|string|min:3|max:255|unique:trends,title',
                'slug' => 'required|string|min:3|max:255|unique:trends,slug',
            ]);

            $trend = new Trend();
            $trend->title = $request->input('title');
            $trend->slug = $request->input('slug');
            $trend->save();

            return redirect()->route('dashboard.trend.create')->with('success', 'Trend created successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'فشل إنشاء الترند. حاول مرة أخرى.']);
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
        $trend = Trend::findOrFail($id);
        return view('dashboard.edittrend', compact('trend'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $trend = Trend::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'slug'=> 'required|string|max:255|unique:trends,slug,'.$trend->id,
            ]);

            $trend->title = $request->input('title');
            $trend->slug = $request->input('slug');
            $trend->save();

            return redirect()->route('dashboard.trends.index')->with('success', 'Trend updated successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'فشل تحديث الترند. حاول مرة أخرى.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $trend = Trend::findOrFail($id);
            $trend->delete();

            return redirect()->route('dashboard.trends.index')->with('success', 'Trend deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'فشل حذف الترند. حاول مرة أخرى.']);
        }
    }
}
