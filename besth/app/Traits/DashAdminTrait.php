<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Slot;
use App\Models\Rack;
use App\Models\Issue;
use App\Models\Strain;
use App\Models\Infrastructure;
use App\Models\Maintenance;
use DateTime;

trait DashAdminTrait
{

    public function Occupied(){
        return count(Slot::where('status', 'O')->get());
    }

    public function totalAvailable()
    {
        return count(Slot::where('status', 'A')->get());
    }

    public function Available() 
    {
        $qrys =  Slot::with('rack')->select('rack_id', DB::raw('count(status) as total'))
                    ->where('status', 'A')->groupBy('rack_id')->get();
        if(count($qrys) > 0 )
        {
            foreach($qrys as $item)
            {
                $total = $item->total;
            } 
        }
        else {
            $total = 0;
        }
        return $total;
    }

    public function approvedIssues()
    {
        return Issue::with('strain')->where('issue_status', 'Approved')->count();
    }

    public function freeStrains()
    {
        return Strain::where('distributable', 'yes')->count();
    }

    public function ownerStrains()
    {
        return Strain::where('distributable', 'no')->count();
    }

    public function pendigIssues()
    {
        return Issue::where('issue_status', 'confirmed')->count();
    }

    public function cageAssignmentPending()
    {
        return Issue::where('issue_status', 'approved')->count();
    }

    public function totalInfraItems()
    {
        return Infrastructure::where('status', 'Active')->count();
    }


}
