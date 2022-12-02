<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Models\PermissionCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PermissionCategory::with('permissions')->get();
        return inertia('Permissions/Index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:permissions',
            'category_id' => 'required'
        ]);

        $permission = Permission::create([
            'name' => $request->input('name'),
            'permission_category_id' => $request->category_id
        ]);

        return back()->with('successMsg', 'Permission Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Permission::where('id', $id)->delete();
            return back()->with('successMsg', 'Permission deleted successfully!');
        }
        catch(\Exception $e) {
            return back()->with('errorMsg', 'Something went wrong!');
        }
    }

    public function rolePermissions($id) {
        if(!auth()->user()->can('Set Role Permissions ')) {
            abort(403);
        }

        $categories = PermissionCategory::with('permissions')->get();
        $role = Role::where('id', $id)->firstOrFail();
        $rolePermissions = $role->permissions->pluck('id');
        return inertia('Permissions/RolePermissions', compact('role', 'categories', 'rolePermissions'));   
    }

    public function updateRolePermissions(Request $request, $role_id) {
        if(!auth()->user()->can('Set Role Permissions ')) {
            abort(403);
        }
        
        try {
            $role = Role::where('id', $role_id)->firstOrFail();
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);

            return back()->with('successMsg', $role->name.' Permissions updated successfully!');
        }
        catch(\Exception $e) {
            return back()->with('errorMsg', 'Something went wrong!');
        }

    }
}
