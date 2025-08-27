<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

use App\Models\Permission; // ✅ Your Eloquent model


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ✅ Load roles with permissions
        $roles = Role::with('permissions')->get();

        return view('dashboard.allroles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ✅ Get all permissions from your table
        $permissions = Permission::all();
        return view('dashboard.addrole', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ 1. Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // ✅ 2. Create new role
        $role = Role::create([
            'name' => $validated['name'],
        ]);

        // ✅ 3. Attach permissions if selected
        if (!empty($validated['permissions'])) {
            $role->permissions()->attach($validated['permissions']);
        }

        // ✅ 4. Redirect with success message
        return redirect()->route('dashboard.role.create')
            ->with('success', 'تم إنشاء الدور بنجاح مع الصلاحيات.');
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
