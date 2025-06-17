<?php

namespace App\Http\Controllers\Spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('users.admin.spatie.permissions.index', compact('permissions'));;

    }

    public function create()
    {
        return view('users.admin.spatie.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
        ]);

        $validated['guard_name'] = 'web';
        Permission::create($validated);

        flash()->options(["position" => "bottom-right"])->success('Permission created successfully.');

        return redirect()->route('admin.permission.index');
    }

    public function edit(Permission $permission)
    {
        return view('users.admin.spatie.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
        ]);
        $permission->update($validated);
        flash()->options(["position" => "bottom-right"])->success('Permission updated successfully.');
        return redirect()->route('admin.permission.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        flash()->options(["position" => "bottom-right"])->success('Permission deleted successfully.');
        return redirect()->route('admin.permission.index');
    }
}
