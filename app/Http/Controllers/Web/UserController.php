<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    private function users()
    {
        return User::where("role", "!=", "admin");
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

        return redirect()->back()->with('message', 'Updated successfully');
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
