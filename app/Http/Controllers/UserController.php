<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            // Delete previous image if exists
            if ($user->image && file_exists(public_path('images/' . $user->image))) {
                unlink(public_path('images/' . $user->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Delete user's image if exists
        if ($user->image && file_exists(public_path('images/' . $user->image))) {
            unlink(public_path('images/' . $user->image));
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function follow(Request $request, User $user)
{
    $currentUser = Auth::user();

    if ($currentUser->isFollowing($user)) {
        $currentUser->unfollow($user);
    } else {
        $currentUser->follow($user);
    }

    return back();
}

}
