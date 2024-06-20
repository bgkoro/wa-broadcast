<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('has-permission', 'manage_roles');

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'Roles',
            'roles' => Role::latest()->filter(request(['search']))->paginate($perPage)->withQueryString()
        ];

        return view('pages.role.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $validated = $request->validated();

        Role::create($validated);

        return redirect()->route('role.index')->with('success', $validated['name'] . ' role has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->authorize('has-permission', 'manage_roles');

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'Role ' . $role->name,
            'role' => $role,
            'permissions' => Permission::latest()->get(),
            'rolesPermissions' => $role->permission()->wherePivot('role_id', $role->id)->latest()->filter(request(['search']))->paginate($perPage)
        ];

        return view('pages.role.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize('has-permission', 'manage_roles');

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'Edit Role',
            'role' => $role,
            'roles' => Role::latest()->filter(request(['search']))->paginate($perPage)->withQueryString()
        ];
        return view('pages.role.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        Role::where('id', $role->id)->update($validated);

        return redirect()->route('role.index')->with('success', $validated['name'] . ' role has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('has-permission', 'manage_roles');

        Role::destroy($role->id);

        return redirect()->route('role.index')->with('success', $role->name . ' role has been deleted');
    }

    /**
     * Toggle the specified resource from role permission.
     */
    public function togglePermission(Request $request, Role $role)
    {
        $this->authorize('has-permission', 'manage_role_permissions');

        $validated = $request->validate([
            'permission' => 'required'
        ]);

        $role->permission()->toggle($validated);

        return redirect()->route('role.show', ['role' => $role->id])->with('success', 'permission han been added to role');
    }

    /**
     * Detech the specified resource from role permission.
     */
    public function detachPermission(Role $role, Permission $permission)
    {
        $this->authorize('has-permission', 'manage_role_permissions');

        $role->permission()->detach($permission->id);

        return redirect()->route('role.show', ['role' => $role->id])->with('success', 'permission han been removed from role');
    }
}
