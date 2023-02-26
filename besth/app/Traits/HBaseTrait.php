<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use DateTime;

trait HBaseTrait
{
    
    public function fetchQuarantHerdIdByCatGender($gender)
    {
        return Herd::where('category', 'quarantine')->where('gender', $gender)->first();
    }
    
    
}