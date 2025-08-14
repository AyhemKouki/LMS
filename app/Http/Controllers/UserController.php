<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('users.user.dashboard.dashboard');
    }

    public function instructor_index()
    {
        return view('users.user.dashboard.instructor_dashboard');
    }

    public function listUsers(){
        $users = User::all();
        return view('users.user.index', compact('users'));
    }

    public function  userRole(User $user)
    {
        $roles = Role::all();
        $checkedRoles = $user->roles()->pluck('id')->toArray();
        return view('users.user.userRole' , compact('user','roles' , 'checkedRoles'));
    }

    public function manageUserRole(Request $request , User $user)
    {
        $user->syncRoles($request->roles);

        $user->role = $request->roles[0] ?? 'student';
        $user->save();

        flash()->options(["position" => "bottom-right"])->success('User Role Updated Successfully');
        return redirect()->route('admin.user.list');

    }

    public function edit(User $user)
    {
        return view('users.admin.dashboard.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($request->only(['name', 'email', 'phone']));

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }
            $user->profile_image = $request->file('profile_image')->store('profile-images');
            $user->save();
        }

        flash()->options(["position" => "bottom-right"])->success('User Updated Successfully');
        return redirect()->route('admin.alluser.index');
    }

    public function destroy(User $user)
    {
        Storage::delete($user->profile_image);
        $user->delete();
        flash()->options(["position" => "bottom-right"])->success('User Deleted Successfully');
        return redirect()->route('admin.user.list');
    }

}
