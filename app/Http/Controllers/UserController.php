<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('View Users')) {
            abort(403);
        }

        if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('SuperAdmin')) {
            $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        } else {
            $roles = Role::whereNotIn('name', ['SuperAdmin', 'Admin'])->get();
        }
        $users = User::with('roles')->whereHas('roles', function($query) {
            $query->where('name', '!=', 'SuperAdmin');
        })->get();
        return inertia('Users/Index', compact('roles', 'users'));
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
    public function store(UserRequest $request)
    {
        if(!auth()->user()->can('Create User')) {
            abort(403);
        }

        DB::beginTransaction();
        try {
            $role = Role::where('id', $request->role_id)->firstOrFail();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole($role);
            
            DB::commit();
            return back()->with('successMsg', 'User Created Successfully!');
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->with('errorMsg', 'Something went wrong!');
        }
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
    public function edit(User $user)
    {
        if(!auth()->user()->can('Edit User')) {
            abort(403);
        }

        if($user->hasRole('Admin') && !in_array(auth()->user()->roles[0]->name, ['SuperAdmin', 'Admin'])) {
            abort(403);
        }
        $user->load('roles');
        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        return inertia('Users/Edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if(!auth()->user()->can('Edit User')) {
            abort(403);
        }

        if($user->hasRole('Admin') && !in_array(auth()->user()->roles[0]->name, ['SuperAdmin', 'Admin'])) {
            abort(403);
        }
        DB::beginTransaction();
        try {
            if(isset($request->password)) {
                $newPassword = Hash::make($request->password);
            } else {
                $newPassword = $user->password;
            }

            User::where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $newPassword,
            ]);
            if($user->roles[0]->id !== $request->role_id) {
                $role = Role::where('id', $request->role_id)->firstOrFail();
                $user->roles()->detach();
                $user->assignRole($role);
            }
            
            DB::commit();
            return back()->with('successMsg', 'User Updated Successfully!');
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->with('errorMsg', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('Delete User')) {
            abort(403);
        }

        try {
            User::where('id', $id)->delete();
            return back()->with('successMsg', 'User deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('errorMsg', 'Something went wrong!');
        }
    }
}
