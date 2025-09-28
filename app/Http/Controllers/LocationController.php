<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Validator;

class LocationController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:locations_access']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $pagination = config('pagination.locations_per_page', 20);

            $query = Location::query();

            if ($search = $request->input('search')) {
                $query->where('name', 'LIKE', "%{$search}%");
            }

            if ($type = $request->input('type')) {
                $query->where('type', $type);
            }

            $locations = $query->latest()
                ->paginate($pagination)
                ->appends($request->all());

            return view('dashboard.alllocations', compact('locations'));
        } catch (\Throwable $e) {

            return redirect()
                ->route('dashboard.locations.index')
                ->withErrors(['error' => 'فشل تحميل المواقع. حاول مرة أخرى.']);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addlocation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Validator::validate($request->all(), [
                'name' => 'required|string|unique:locations,name',
                'slug' => 'required|string|unique:locations,slug',
                'type' => 'required|in:city,continent,country',
            ]);

            Location::create($request->all());

            return redirect()->back()->with('success', 'Location created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create location: ' . $e->getMessage());
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
        $location = Location::findOrFail($id);
        return view('dashboard.editlocation', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            Validator::validate($request->all(), [
                'name' => 'required|string|unique:locations,name,' . $id,
                'slug' => 'required|string|unique:locations,slug,' . $id,
                'type' => 'required|in:city,continent,country',
            ]);

            $location = Location::findOrFail($id);
            $location->update($request->only('name', 'slug', 'type'));

            return redirect()->back()->with('success', 'Location updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update location: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $location = Location::findOrFail($id);
            $location->delete();

            return redirect()->back()->with('success', 'Location deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete location: ' . $e->getMessage());
        }
    }
}
