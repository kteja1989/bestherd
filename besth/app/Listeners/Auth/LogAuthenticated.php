<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Storage;

class LogAuthenticated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
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
    		$message = '[ '.date('d-m-Y H:i:s').' ] user: [ '.$username.' ] authenticated';
    		Storage::prepend('authentications.txt', $message);
		}
    }
}
