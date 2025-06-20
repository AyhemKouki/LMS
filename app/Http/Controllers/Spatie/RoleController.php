<?php

namespace App\Http\Controllers\Spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('users.admin.spatie.roles.index', compact('roles'));

    }

    public function create()
    {
        return view('users.admin.spatie.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
        ]);
        Role::create($validated + ['guard_name' => 'web']);
        flash()->options(["position" => "bottom-right"])->success('Role created successfully.');
        return redirect()->route('admin.role.index');
    }

    public function edit(Role $role)
    {
        return view('users.admin.spatie.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
        ]);
        $role->update($validated);
        flash()->options(["position" => "bottom-right"])->success('Role updated successfully.');
        return redirect()->route('admin.role.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        flash()->options(["position" => "bottom-right"])->success('Role deleted successfully.');
        return redirect()->route('admin.role.index');
    }

    public function rolePermission(Role $role)
    {
        $permissions = Permission::all();
        $checkedPermissions = $role->permissions()->pluck('id')->toArray();
        return view('users.admin.spatie.roles.rolePermission' , compact('role','permissions' , 'checkedPermissions'));
    }

    public function manageRolePermission(Request $request , Role $role)
    {
        $role->syncPermissions($request->permissions);
        flash()->options(["position" => "bottom-right"])->success('Role Permission Updated Successfully');
        return redirect()->route('admin.role.index');
    }
}
