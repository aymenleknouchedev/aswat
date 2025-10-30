<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use Notifiable;

    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$request->user()->hasPermission('users_access')) {
            return redirect()->route('dashboard.index')->with('error', 'Unauthorized access');
        }
        $users = User::all();
        return view('dashboard.allusers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$request->user()->hasPermission('users_access')) {
            return redirect()->route('dashboard.index')->with('error', 'Unauthorized access');
        }

        $roles = Role::all(); // ✅ استرجاع كل الأدوار
        return view('dashboard.adduser', compact('roles'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$request->user()->hasPermission('users_access')) {
            return redirect()->route('dashboard.index')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id', // نتأكد كل role موجود
        ]);

        // ✅ Default image
        $imageName = 'user.png';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $path = asset('storage/' . $file->store('users', 'public'));
            $imageName = $path;
        }

        // ✅ Create user
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
        ]);

        // ✅ Attach multiple roles
        $user->roles()->sync($request->roles);

        return redirect()
            ->route('dashboard.user.create')
            ->with('success', 'تمت إضافة المستخدم مع الأدوار بنجاح');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {

        $user = Auth::user();

        if (!$user || !$request->user()->hasPermission('users_access')) {
            return redirect()->route('dashboard.index')->with('error', 'Unauthorized access');
        }

        return view('dashboard.auth.show', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $user = Auth::user();
        $roles = Role::all();
        if (!$user || !$request->user()->hasPermission('users_access')) {
            return redirect()->route('dashboard.index')->with('error', 'Unauthorized access');
        }

        $user = User::findOrFail($id);
        return view('dashboard.edituser', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        if (!$user || !$request->user()->hasPermission('users_access')) {
            return redirect()->route('dashboard.index')->with('error', 'Unauthorized access');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'image' => 'nullable',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'token' => '',
        ]);

        $user = User::findOrFail($id);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $path = asset('storage/' . $request->file('image')->store('users', 'public'));
            $user->image = $path;
        }


        // Update user details
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->email = $request->email;
        //roles
        $user->roles()->sync($request->roles);
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();


        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $user = Auth::user();

        if (!$user || !$request->user()->hasPermission('users_access')) {
            return redirect()->route('dashboard.index')->with('error', 'Unauthorized access');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard.users.index')
            ->with('success', 'تم حذف المستعمل بنجاح.');
    }


    public function auth()
    {
        return view('dashboard.auth');
    }

    /**
     * Logout the user.
     */
    public function login(Request $request)
    {
        // ✅ التحقق من المدخلات
        $credentials = $request->validate([
            'email' => 'nullable|email',
            'username' => 'nullable|string',
            'password' => 'required|min:6',
        ]);

        // محاولة تسجيل الدخول باستخدام البريد الإلكتروني
        if (!empty($credentials['email'])) {
            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                return redirect()->route('dashboard.index')
                    ->with('success', 'تم تسجيل الدخول بنجاح');
            }
        }

        // محاولة تسجيل الدخول باستخدام اسم المستخدم
        if (!empty($credentials['username'])) {
            if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                return redirect()->route('dashboard.index')
                    ->with('success', 'تم تسجيل الدخول بنجاح');
            }
        }

        // ❌ في حالة فشل الدخول
        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو اسم المستخدم أو كلمة المرور غير صحيحة.',
        ])->onlyInput('email', 'username');
    }
    //logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('dashboard.user.auth')->with('message', 'Logged out successfully');
    }
}
