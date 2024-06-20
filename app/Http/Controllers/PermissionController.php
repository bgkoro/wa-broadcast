<?php

namespace App\Http\Controllers;

use App\Models\permission;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('has-permission', 'manage_permissions');

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'Permissions',
            'permissions' => Permission::latest()->filter(request(['search']))->paginate($perPage)->withQueryString()
        ];
        return view('pages.permission.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $validated = $request->validated();

        Permission::create($validated);

        return redirect()->route('permission.index')->with('success', $validated['name'] . ' permission has been created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $this->authorize('has-permission', 'manage_permissions');

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'Edit Permission',
            'permission' => $permission,
            'permissions' => Permission::latest()->filter(request(['search']))->paginate($perPage)->withQueryString()
        ];
        return view('pages.permission.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $this->authorize('has-permission', 'manage_permissions');

        $validated = $request->validated();
        Permission::where('id', $permission->id)->update($validated);

        return redirect()->route('permission.index')->with('success', $validated['name'] . ' permission has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('has-permission', 'manage_permissions');

        Permission::destroy($permission->id);

        return redirect()->route('permission.index')->with('success', $permission->name . ' permission has been deleted');
    }
}
