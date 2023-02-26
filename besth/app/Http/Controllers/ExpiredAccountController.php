<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ExpiredAccountController extends Controller
{
    //
    public function index(Closure $next)
    { //dd( strtotime(Auth::user()->expiry_date), strtotime(date('Y-m-d')));
      $exp = strtotime(Auth::user()->expiry_date);
      $tod = strtotime(date('Y-m-d'));

      if( $exp <= $tod)
      {
        $msg = "Your Account Expired on ". Auth::user()->expiry_date." Contact Service Provider";
        //return  view('norole.noroleHome');
        return  view('errors.dashboard')->with('msg', $msg);
      }else {
        return $next($request);
      }
    }
}
