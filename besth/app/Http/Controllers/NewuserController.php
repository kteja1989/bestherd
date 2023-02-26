<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//models
use App\Models\User;
//traits
use App\Traits\Base; //
use App\Traits\DashAdminTrait;
//use App\Actions\Fortify\PasswordValidationRules;

use Mail;
use App\Mail\NewUserEMail;
use Illuminate\Support\Facades\Route;

use App\Traits\ActiveUsers;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class NewuserController extends Controller
{
    use HasRoles;
    use DashAdminTrait;
  //  use PasswordValidationRules;
    use Base; //
    use ActiveUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ideally should be open for all investigators and enterprise
        // managers etc., to register and come through email verification
        //process.
        if( Auth::user()->hasRole('pisg|pibg|piblg|bestadmin') )
  		{
          $users = $this->activeUsers();
          //dd($users);
          return view('createusers.createUserHome')
                    ->with([ 'guestUsers'=>$users ]);
        }
        else {
          return view('norole.noroleHome');
        }
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
        if( Auth::user()->hasRole('pisg|pibg|piblg|bestadmin') )
  		{
      		$newUser = $request->all();

            Validator::make($newUser, [
                'name' => ['required', 'string', 'max:55'],
                'email' => ['required', 'string', 'email', 'max:55', 'unique:users'],
                'st_date' => ['required', 'date'],
                'end_date' => ['required', 'after:st_date'],
            ])->validate();

            switch ($newUser['role']) {
              case "Principle Investigator":
                  $newUser['role'] = 'pisg'; //user's table
                break;
              case "Manager":
                  $newUser['role'] = 'manager';
                break;
              default:
                $newUser['role'] = 'guest';
            }

            $newUser['folder'] = $this->generateCode(15); //

            //$newUser['password'] = $this->generateCode(10);
            $newUser['password'] = "asdf1234"; //should be loggable

            $newUserResult = User::create([
                'name' => $newUser['name'],
                'email' => $newUser['email'],
                'password' => Hash::make($newUser['password']),
                'folder' => $newUser['folder'],
                'role' => $newUser['role'],
                'start_date' => $newUser['st_date'],
                'expiry_date' => $newUser['end_date'],
            ]);

            // now assign Role
            $newUserResult->assignRole('investigator');

            //now send mail to the newly registered user using registered event
            event(new Registered($newUserResult));

            $users = $this->activeUsers();
            //dd($users);

            return view('createusers.createUserHome')->with([
                        'guestUsers'=> $users
                      ]);
  		}
        else {
          return view('norole.noroleHome');
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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        //dd($user);
        $userRole = $user->roles->pluck('name')->all();
        //dd($userRole);
        return view('createusers.editUserDetails', compact('user','userRole'));
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
        //
    }
}
