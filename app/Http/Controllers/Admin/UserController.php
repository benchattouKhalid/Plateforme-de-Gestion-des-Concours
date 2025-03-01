<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Region;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Render the create user form
        $regions = Region::all(); // Fetch all regions
        return view('admin.users.create', compact('regions'));

    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,candidat,gestionnaire_local,gestionnaire_global',
        'region' => 'nullable|string', // Validate region name
    ]);

    $region = Region::where('name', $request->region)->first();

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'region' => $request->region, // Associate region by name
    ]);

    return redirect()->route('index')->with('success_create', 'User created successfully!');
}



    public function edit($id)
    {
        // Fetch user by ID
        $user = User::findOrFail($id);
        $regions = Region::all();
        return view('admin.users.edit', compact( 'user' , 'regions' ));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'role' => 'required|in:admin,candidat,gestionnaire_local,gestionnaire_global',
        'region' => 'nullable|string',
    ]);

    $user = User::findOrFail($id);
    $region = Region::where('name', $request->region)->first();

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'region' => $request->region,
    ]);

    return redirect()->route('index')->with('success_update', 'User updated successfully!');
}

    public function destroy($id)
    {
        // Fetch user by ID and delete
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect with success message
        return redirect()->route('index')->with('success_destroy', 'User deleted successfully!');
    }
}
