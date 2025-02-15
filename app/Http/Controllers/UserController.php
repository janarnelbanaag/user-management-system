<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ApiService;
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
            return ApiService::response(
                'Successful',
                $this->users()->findOrFail($id)
            );
        }

        return ApiService::response(
            'Successful',
            $this->users()->get()
        );
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return ApiService::response(
            'Updated successfully',
            $user
        );
    }

    public function delete(string $id)
    {
        $deleted = User::destroy($id);

    if ($deleted) {
        return ApiService::response(
            'User deleted successfully',
            $deleted,
            200
        );
    }

        return ApiService::response(
            'User not found or already deleted',
            "",
            404
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
