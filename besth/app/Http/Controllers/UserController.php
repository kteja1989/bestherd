<?php
          
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class UserController extends Controller
{
    //isAdmin middleware lets only users with a
	//specific permission permission to access these resources
	public function __construct() {
        $this->middleware(['auth']);
    }

		/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if( Auth::user()->hasRole('pisg|bestadmin') )
		{
			//Get all users and pass it to the view
            $users = User::where('id', '<>', 1)
						->whereIn('role', ['herdmanager', 'manager', 'pient',  'researcher', 'guest'])
						->get();
			
            return view('users.index')->with('users', $users);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		//Get all roles and pass it to the view
		if( Auth::user()->hasRole('pisg|bestadmin') )
		{
            $roles = Role::where('name','<>', 'admin')
                            ->where('name', '<>', 'bestadmin')
                            ->where('name', '<>', 'investigator')
    						->where('name', '<>', 'pisg')
    						->where('name', '<>', 'pilg')
    						->where('name', '<>', 'piblg')
    						->where('name', '<>', 'bestadmin')
    						->pluck('name', 'id');
            return view('users.ncreate', ['roles'=>$roles]);
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if( Auth::user()->hasRole('superadmin|bestadmin') )
		{
			//Validate name, email and password fields
	        $this->validate($request, [
	            'name'       => 'required|max:120',
	            'email'      => 'required|email|unique:users',
	            'password'   => 'required|min:6|confirmed',
	            'roles.*'    => 'required|alpha',
	            'start_date' => 'required|date',
                'end_date'   => 'required|after:start_date',
	        ]);
	        
			//Retrieving only the email and password data
			$input = $request->only('email', 'name', 'password', 'roles', 'start_date', 'end_date');
			
			$input['password'] = Hash::make($input['password']);

            $input['role'] = $input['roles'][0];
            
	        $user = User::create($input);
	        
	        //now send mail to the newly registered user using registered event
            event(new Registered($newUserResult));

	        $roles = $request['roles']; //Retrieving the roles field
			
			//Checking if a role was selected
	        if (isset($roles))
			{
	            foreach ($roles as $role)
				{
		            $role_r = Role::where('id', '=', $role)->firstOrFail();
		            $user->assignRole($role_r); //Assigning role to user
	            }
	        }
			
			//Redirect to the users.index view and display message
            return redirect()->route('users.index')
                                    ->with('flash_message', 'User successfully added.');
	    }
        else {
  			return view('livewire.permError');
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
		return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = intval($id);
		if( Auth::user()->hasRole('bestadmin') )
		{
    		//Get user with specified id
    		$user = User::findOrFail($id);
    		//Get all roles
            $exclude = ['admin','pisg','pilg','piblg'];
            $roles = Role::whereNotIn('name', $exclude)->get();
            return view('users.edit', compact('user', 'roles'));
    	}
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
        // There is no need to update password or anything
        //as the user comes through email verification
        
        $user = User::findOrFail($id); //Get role specified by id
        
        //Validate name, email and password fields
        $this->validate($request, [
		  	'role'       =>'required|numeric',
			'expiry_date'=>'required|date',
		]);
        //  Retreive the name, email and password fields
        // $input = $request->only(['name', 'email', 'password']);
        // $input['password'] = Hash::make($input['password']);
        
        //Retreive all roles
        //Retreive all inputs
        $input = $request->only('role', 'expiry_date');
        
        //no update expiry date
        $user->fill($input)->save();
        
        if ($input['role'] != null) {
            $user->roles()->sync(intval($input['role']));  //If one or more role is selected associate user to roles
        }
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('users.index')
            ->with('flash_message',
            'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if( Auth::user()->hasRole('bestadmin') )
		{
        //Find a user with a given id and delete
            $user = User::findOrFail($id);
            //$user->delete();
            return redirect()->route('users.index')
                                ->with('flash_message',
                                'User successfully deleted.');
		}

    }
}
