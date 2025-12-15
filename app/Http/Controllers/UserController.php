<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua user dengan pagination (10 user per halaman)
        $users = User::latest()->paginate(10);
        
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Array role yang tersedia
        $roles = [
            'super_admin' => 'Super Admin',
            'admin' => 'admin',
        ];
        
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,penulis,user',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_telepon' => 'nullable|string|max:20'
        ]);

        // Handle upload avatar jika ada
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Simpan user
        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        
        // Array role yang tersedia
        $roles = [
            'super_admin' => 'Super Admin',
            'admin' => 'admin',
        ];
        
        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|in:admin,penulis,user',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_telepon' => 'nullable|string|max:20'
        ]);

        // Handle upload avatar jika ada
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Hapus avatar jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Update last login timestamp.
     */
    public function updateLastLogin($userId)
    {
        $user = User::find($userId);
        
        if ($user) {
            $user->update([
                'last_login' => now()
            ]);
        }
        
        return $user;
    }

    /**
     * Search users by name or email.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $users = User::where('nama_lengkap', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->latest()
            ->paginate(10);
            
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show user profile.
     */
    public function profile()
    {
        $user = auth()->user();
        
        return view('admin.user.profile', compact('user'));
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_telepon' => 'nullable|string|max:20'
        ]);

        // Handle upload avatar jika ada
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}