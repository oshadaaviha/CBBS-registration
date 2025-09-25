<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\UserPermission;
use Illuminate\Http\Request;


class UserAccessManagementController extends Controller
{
    public function index()
    {
        $branches = Branch::where('isActive', 1)->get();
        $users = User::with('permissions')
        ->where('isActive', 1)
        ->where('role', '!=', 'sales')
        // ->whereIn('role', ['Admin', 'Manager'])
        ->get();
        return view('user.userAccessManagement', compact('users', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $permissions = $request->input('permissions', []);
        $user->permissions()->delete();

        foreach ($permissions as $perm) {
        UserPermission::create([
            'user_id' => $user->id, // Link to user
            'permission' => $perm
        ]);
    }
        // foreach ($permissions as $perm) {
        //     UserPermission::create(['role' => $user->role, 'permission' => $perm]);
        // }

        // $user->permissions()->delete();
        // foreach ($request->input('permissions', []) as $perm) {
        //     $user->permissions()->create(['permission' => $perm]);
        // }

        return redirect()->back()->with('success', 'Permissions updated!');
    }
}
