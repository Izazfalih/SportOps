<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role Filter
        if ($request->filled('role') && $request->role !== 'All Roles') {
            $roleFilter = strtolower($request->role);
            if ($roleFilter === 'staff') {
                $roleFilter = 'penjaga';
            }
            $query->where('role', $roleFilter);
        }

        // Status Filter
        if ($request->filled('status') && $request->status !== 'All Status') {
            $isActive = $request->status === 'Active' ? 1 : 0;
            $query->where('is_active', $isActive);
        }

        $usersData = $query->orderBy('created_at', 'desc')->paginate(10);

        // Stats
        $stats = [
            'total_users' => User::count(),
            'active_staff' => User::where('role', 'penjaga')->where('is_active', true)->count(),
            'new_this_month' => User::whereMonth('created_at', Carbon::now()->month)->count(),
        ];

        return view('admin.users', compact('usersData', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'role' => 'required|in:User,Admin,Staff',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role = strtolower($request->role);
        if ($role === 'staff') {
            $role = 'penjaga';
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $role,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string|max:20',
            'role' => 'required|in:User,Admin,Staff',
        ]);

        $role = strtolower($request->role);
        if ($role === 'staff') {
            $role = 'penjaga';
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $role,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User status updated successfully.');
    }
}
