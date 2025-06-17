<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('users');

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', '=', $request->role);
        }

        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }
        return view('admin.users.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }
        return  view('admin.users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'role' => 'required|string|in:0,1,2',
        ]);
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }
        DB::table('users')->where('id', $id)->update([
            'role' => $data['role'],
        ]);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
