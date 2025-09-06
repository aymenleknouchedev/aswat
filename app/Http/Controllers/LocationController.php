<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Routing\Controller as BaseController;

class LocationController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:locations_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Location::where('type', 'country')->paginate(10);
        $continents = Location::where('type', 'continent')->paginate(10);
        $cities = Location::where('type', 'city')->paginate(10);



        return view('dashboard.alllocations', compact('countries', 'continents', 'cities'));
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
        $location = new Location();
        $location->name = $request->input('name');
        $location->type = $request->input('type');
        $location->save();

        return redirect()->route('dashboard.locations.index')->with('success', 'Location created successfully.');
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
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('dashboard.locations.index')->with('success', 'Location deleted successfully.');
    }
}
