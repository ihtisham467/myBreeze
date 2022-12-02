<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('View Roles')) {
            abort(403);
        }

        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        return inertia('Roles/Index', compact('roles'));
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
        if(!auth()->user()->can('Create Role')) {
            abort(403);
        }

        $this->validate($request, [
            'name' => 'required|min:3|unique:roles',
        ]);

        Role::create([
            'name' => $request->input('name'),
        ]);

        return back()->with('successMsg', 'Role Created Successfully!');
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
        if(!auth()->user()->can('Delete Role')) {
            abort(403);
        }

        try {
            $role = Role::withCount('users')->where('id', $id)->firstOrFail();
            if($role->users_count > 0) {
                return back()->with('errorMsg', 'This Role cannot be deleted because it has users attached!');
            }
            $role->delete();
            return back()->with('successMsg', 'Role deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('errorMsg', 'Something went wrong!');
        }
    }
}
