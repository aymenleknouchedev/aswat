<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

use App\Services\CacheService;
use App\Enums\CacheKeys;

class PermissionController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:roles_access']);
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $ttl = config('cache_ttl.permissions', 3600);
    //     $permissions = CacheService::remember(CacheKeys::PERMISSIONS, function () {
    //         return Permission::all();
    //     }, $ttl);
    //     return view('dashboard.allpermissions', compact('permissions'));
    // }

    public function index(Request $request)
    {
        try {
            $ttl = config('cache_ttl.permissions', 3600);

            $query = Permission::query();

            if ($search = $request->input('search')) {
                $query->where('name', 'LIKE', "%{$search}%");
            }

            if (!$search) {
                $permissions = CacheService::remember(CacheKeys::PERMISSIONS, function () {
                    return Permission::orderBy('id', 'desc')->get();
                }, $ttl);
            } else {
                $pagination = config('pagination.permissions_per_page', 20);
                $permissions = $query->orderBy('id', 'desc')
                                    ->paginate($pagination)
                                    ->appends($request->all());
            }

            return view('dashboard.allpermissions', compact('permissions'));
        } catch (\Throwable $e) {
            return redirect()
                ->route('dashboard.permissions.index')
                ->withErrors(['error' => 'فشل تحميل الصلاحيات. حاول مرة أخرى.']);
        }
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
        try {
            $validated = Validator::validate($request->all(), [
                'name' => 'required|string|unique:permissions,name',
            ])->validate();

            Permission::create(['name' => $validated['name']]);

            CacheService::forget(CacheKeys::PERMISSIONS);

            return redirect()
                ->route('dashboard.permission.create')
                ->with('success', 'تمت إضافة الصلاحية بنجاح ✅');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.permission.create')
                ->with('error', 'حدث خطأ أثناء إضافة الصلاحية.');
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
        $permission = Permission::findOrFail($id);
        return view('dashboard.editpermission', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        Validator::validate($request->all(), [
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ])->validate();

        if ($request->input('name') === $permission->name) {
            return redirect()->back()->with('info', 'No changes made to the permission.');
        }

        $permission->name = $request->input('name');
        $permission->save();
        CacheService::forget(CacheKeys::PERMISSIONS);

        return redirect()->back()->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return redirect()->back()
                ->with('success', 'Permission deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete permission.');
        }
    }
}
