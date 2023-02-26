<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class RoleController extends Controller
{
    public function __construct() {
			$this->middleware(['auth', 'isAdmin']);
    }

		/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all roles
        if( Auth::user()->hasRole('admin') )
				{
          $roles = Role::where('name','<>',['admin','pisg','pilg','piblg'])->get();//Get all roles
          return view('roles.index')->with('roles', $roles);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$permissions = Permission::pluck('name', 'id');//Get all permissions
        return view('roles.create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//Validate name and permissions field
        $this->validate($request, [
            'name'=>'required|unique:roles|max:15',
            'permission' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;
        $perms = $request['permission'];
        $role->save();
         //Looping thru selected permissions
        foreach ($perms as $permission)
        {
            $p = Permission::where('name', '=', $permission)->firstOrFail();
			      //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first();
			      //this function does not seem to keep the old permissions
            // it should keep the existing ones intact while adding new.
            $role->givePermissionTo($p->id);
        }

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role'. $role->name.' added!');
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
				return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::pluck('name', 'id');
        return view('roles.edit', compact('role', 'permissions'));

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
        $role = Role::findOrFail($id);//Get role with the given id
		//Validate name and permission fields
		$input = $request['permission'];

        $this->validate($request, [
            'name'=>'required|max:10|unique:roles,name,'.$id,
            'permission' =>'required',
        ]);

        $input = $request->except(['permission']);
        $permissions = $request['permission'];
        $role->fill($input)->save();
        $p_all = Permission::all();//Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role'. $role->name.' updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role deleted!');
    }
}
