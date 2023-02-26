<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;  //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $array = [
                   "demosupadmin@demo.com",
                   "testherdmanager@demo.com",
                   "Super Admin",
                   "Testherd Manager"
                ];
                  
        $username = $event->user->name;
        
        if(!in_array($username, $array))
        {
            $guardName = $event->guard;
            $ip = $this->request->ip();
            $message = '[ '.date('d-m-Y H:i:s').' ] user: [ '.$username.' ] with IP: [ '.$ip.' ] logged in';
            Storage::prepend('loginactivity.txt', $message);
        }
    }
}
