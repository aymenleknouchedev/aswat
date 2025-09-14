<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

use App\Models\Permission;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Validator;
use App\Services\CacheService;
use App\Enums\CacheKeys;

class RoleController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:roles_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            
            $ttl = config('cache_ttl.roles', 3600);

            $query = Role::query();

            if ($search = $request->input('search')) {
                $query->where('name', 'LIKE', "%{$search}%");
            }

            if (!$search) {
                $roles = CacheService::remember(CacheKeys::ROLES, function () {
                    return Role::orderBy('id', 'desc')->get();
                }, $ttl);
            } else {
                $pagination = config('pagination.per20', 20);
                $roles = $query->orderBy('id', 'desc')
                                    ->paginate($pagination)
                                    ->appends($request->all());
            }
            return view('dashboard.allroles', compact('roles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء جلب الأدوار.');
        }
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
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('dashboard.editrole', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->name = $request->input('name');
        $role->save();

        // Sync permissions
        if (!empty($request->input('permissions'))) {
            $role->permissions()->sync($request->input('permissions'));
        }

        return redirect()->route('dashboard.roles.index')->with('success', 'تم تحديث الدور بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('dashboard.roles.index')
            ->with('success', 'تم حذف الدور بنجاح.');
    }
}
