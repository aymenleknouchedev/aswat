<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

use Illuminate\Routing\Controller as BaseController;

class PermissionController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:roles_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard.allpermissions', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addpermission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        // ✅ Create permission
        Permission::create(['name' => $validated['name']]);

        // ✅ Redirect with success message
        return redirect()
            ->route('dashboard.permission.create')
            ->with('success', 'تمت إضافة الصلاحية بنجاح ✅');
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
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('dashboard.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
