<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    private function users()
    {
        return User::where("role", "!=", "admin");
    }

    public function addUser() {
        return Inertia::render('Auth/ViewUser');
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'first_name'   => 'required|string',
            'last_name'    => 'required|string',
            'address'      => 'required|string',
            'postcode'     => 'required|string',
            'phone_number' => 'required|string',
            'email'        => 'required|email|unique:users,email',
            'username'     => 'required|string|max:255|unique:users,username',
            'password'     => 'required|string|min:6',
            'role'         => 'required|in:user,admin',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('dashboard')->with('message', 'User added successfully');
    }

    public function get(string $id = null)
    {
        if ($id) {
            $user = $this->users()->findOrFail($id);
            return Inertia::render('Auth/ViewUser', ['user' => $user]);
        }

        $users = $this->users()->get();
        return Inertia::render('Dashboard', ['users' => $users]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('dashboard')->with('message', 'Updated successfully');
    }

    public function delete(string $id)
    {
        $deleted = User::destroy($id);

        if ($deleted) {
            return redirect()->back()->with('message', 'User deleted successfully');
        }

        return redirect()->back()->withErrors(['error' => 'User not found or already deleted']);
    }

}
