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
            'image' => 'nullable',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id', // نتأكد كل role موجود
        ]);

        // If image is not provided, assign 'user.png'
        $image = $request->image ?? 'user.png';

        // ✅ Create user
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image,
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
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->filled('image')) {
            $user->image = $request->input('image');
        }

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
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $loginValue = $request->input('login');
        $password = $request->input('password');

        // Check if it's an email or username
        $loginField = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginField => $loginValue, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index')->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()->withErrors([
            'login' => 'اسم المستخدم أو البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ])->onlyInput('login');
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
