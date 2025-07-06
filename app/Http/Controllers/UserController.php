<?php

namespace App\Http\Controllers;

use App\Models\User2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|in:Admin,Teacher,Student,Parent',
        ]);

        $user = User2::create([
            'username'  => $validated['username'],
            'password'  => Hash::make($validated['password']),
            'role'      => $validated['role'],
            'is_active' => true,
            'last_login' => now(),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    public function index()
    {
        $users = User2::select('id', 'username', 'role', 'is_active', 'last_login', 'created_at')->get();

        return response()->json([
            'message' => 'Users fetched successfully',
            'users' => $users
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User2::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'username' => ['string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'role'     => 'string|in:Admin,Teacher,Student,Parent',
            'is_active' => 'boolean',
        ]);

        if (isset($validated['username'])) {
            $user->username = $validated['username'];
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if (isset($validated['role'])) {
            $user->role = $validated['role'];
        }

        if (isset($validated['is_active'])) {
            $user->is_active = $validated['is_active'];
        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    public function show($id)
    {
        $user = User2::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'message' => 'User fetched successfully',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User2::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}


