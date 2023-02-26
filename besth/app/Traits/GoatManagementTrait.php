<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Goat;
use App\Models\Herd;
use App\Models\Immunization;
use App\Models\Immunedgoats;
use App\Models\Serum;
use App\Models\Goatsera;
use App\Models\Health;
use App\Models\Goathealth;

use DateTime;

use App\Traits\Base;


trait GoatManagementTrait
{
    use Base;

    public function agedGoatsGT10years()
    {
      $sd10y = date('Y-m-d', strtotime("-120 months"));
      $ot10y = Goat::where('dob', '<=', $sd10y)
                      //->where('dob', '>=', $sd10y)
                      ->get();
      return $ot10y;
    }

    public function agedGoatsGT09years()
    {
      $sd09y = date('Y-m-d', strtotime("-108 months"));
      $sd10y = date('Y-m-d', strtotime("-120 months"));
      $ot09y = Goat::where('dob', '<=', $sd10y)
                      ->where('dob', '>=', $sd10y)
                      ->get();
      return $ot09y;
    }

    public function agedGoatsGT08years()
    {
      $sd08y = date('Y-m-d', strtotime("-96 months"));
      $sd09y = date('Y-m-d', strtotime("-108 months"));
      $ot08y = Goat::where('dob', '<=', $sd08y)
                      ->where('dob', '>=', $sd09y)
                      ->get();
      return $ot08y;
    }

    public function agedGoatsGT07years()
    {
      $sd07y = date('Y-m-d', strtotime("-84 months"));
      $sd08y = date('Y-m-d', strtotime("-96 months"));
      $ot07y = Goat::where('dob', '<=', $sd07y)
                      ->where('dob', '>=', $sd08y)
                      ->get();
      return $ot07y;
    }

    public function agedGoatsGT06years()
    {
      $sd06y = date('Y-m-d', strtotime("-72 months"));
      $sd07y = date('Y-m-d', strtotime("-84 months"));
      $ot06y = Goat::where('dob', '<=', $sd06y)
                      ->where('dob', '>=', $sd07y)
                      ->get();
      return $ot06y;
    }

    public function agedGoatsGT05years()
    {
      $sd05y = date('Y-m-d', strtotime("-60 months"));
      $sd06y = date('Y-m-d', strtotime("-72 months"));
      $ot05y = Goat::where('dob', '<=', $sd05y)
                      ->where('dob', '>=', $sd06y)
                      ->get();
      return $ot05y;
    }

    public function agedGoatsGT04years()
    {
      $sd04y = date('Y-m-d', strtotime("-48 months"));
      $sd05y = date('Y-m-d', strtotime("-60 months"));
      $ot04y = Goat::where('dob', '<=', $sd04y)
                      ->where('dob', '>=', $sd05y)
                      ->get();
      return $ot04y;
    }

    public function agedGoatsGT03years()
    {
      $sd03y = date('Y-m-d', strtotime("-36 months"));
      $sd04y = date('Y-m-d', strtotime("-48 months"));
      $ot03y = Goat::where('dob', '<=', $sd03y)
                      ->where('dob', '>=', $sd04y)
                      ->get();
      return $ot03y;
    }

    public function agedGoatsGT02years()
    {
      $sd02y = date('Y-m-d', strtotime("-24 months"));
      $sd03y = date('Y-m-d', strtotime("-36 months"));
      $ot02y = Goat::where('dob', '<=', $sd02y)
                      ->where('dob', '>=', $sd03y)
                      ->get();
      return $ot02y;
    }
    
    public function agedGoatsGT01years()
    {
      $sd01y = date('Y-m-d', strtotime("-12 months"));
      $sd02y = date('Y-m-d', strtotime("-24 months"));
      $ot01y = Goat::where('dob', '<=', $sd01y)
                      ->where('dob', '>=', $sd02y)
                      ->get();
      return $ot01y;
    }
    
    public function agedGoatsGT00years()
    {
      $sd01y = date('Y-m-d', strtotime("-00 months"));
      $sd02y = date('Y-m-d', strtotime("-12 months"));
      $ot01y = Goat::where('dob', '<=', $sd01y)
                      ->where('dob', '>=', $sd02y)
                      ->get();
      return $ot01y;
    }

}
