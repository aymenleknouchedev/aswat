<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function auth()
    {
        return view('dashboard.auth');
    }

    public function index()
    {
        $users = User::all();
        return view('dashboard.allusers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.adduser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required',
        ]);

        // ✅ Default image
        $imageName = 'user.png';

        // ✅ If user uploaded an image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();

            // تخزين داخل storage/app/public/users
            $file->storeAs('/users', $imageName);
        }

        // ✅ Create user
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
            'role' => $request->role,
        ]);

        // ✅ Redirect with success message
        return redirect()
            ->route('dashboard.user.create')
            ->with('success', 'تمت إضافة المستخدم بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.auth.show', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.auth.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'nullable|in:admin,editor,writer',
            'token' => '',
        ]);

        $user = User::findOrFail($id);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/users', $imageName);
            $user->image = $imageName;
        }


        // Update user details
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role ?? 'writer';
        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }

    /**
     * Logout the user.
     */
    //logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('dashboard.auth.login')->with('message', 'Logged out successfully');
    }
}
