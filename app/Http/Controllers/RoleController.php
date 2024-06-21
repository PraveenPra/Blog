<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }

    public function assignPermissions(Role $role)
    {
        $permissions = Permission::all();
 // Get permissions assigned to the current role
 $assignedPermissions = $role->permissions->pluck('id')->toArray();
    
 return view('roles.assign', compact('role', 'permissions', 'assignedPermissions'));

    }
    public function updatePermissions(Request $request, Role $role)
    {
        // Validate the incoming request data
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Sync the selected permissions to the role
        $role->permissions()->sync($request->permissions);

        // Redirect back or wherever appropriate
        return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully');
    }
}
