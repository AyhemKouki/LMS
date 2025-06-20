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
        return view('users.user.layout.layout');
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
    public function destroy(User $user)
    {
        Storage::delete($user->profile_image);
        $user->delete();
        flash()->options(["position" => "bottom-right"])->success('User Deleted Successfully');
        return redirect()->route('admin.user.list');
    }

}
