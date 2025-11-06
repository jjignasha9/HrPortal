<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Role::query()->orderBy('name');
            return DataTables::of($q)
                ->addColumn('permissions', fn($r) => $r->permissions->pluck('name')->implode(', '))
                ->addColumn('action', fn($row) => view('roles.partials.actions', compact('row'))->render())
                ->make(true);
        }
        $permissions = Permission::orderBy('name')->pluck('name');
        return view('roles.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150|unique:roles,name',
            'permissions' => 'nullable|array'
        ]);
        $role = Role::create(['name' => $data['name']]);
        if (!empty($data['permissions'])) $role->givePermissionTo($data['permissions']);
        return response()->json(['message' => 'Role created']);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150|unique:roles,name,'.$role->id,
            'permissions' => 'nullable|array'
        ]);
        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);
        return response()->json(['message' => 'Role updated']);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted']);
    }
}
