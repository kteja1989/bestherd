<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Immunization;
use App\Models\Serum;
use App\Models\Color;
use App\Models\Procedure;
use App\Models\Feed;
use App\Models\Adjuvant;
use App\Models\Herd;
use App\Models\Goat;

use DateTime;

use App\Traits\Base;

trait HerdTaskAlertTrait
{
    public function upcomingImmunizations()
    {
        //$imms = Immunization::all();
        //$imms = Immunization::max('created_at')->groupBy('herd_id')->get();
        
        $imms = Immunization::select( 'frequency','herd_id', DB::raw('MAX(created_at) as max_immunized_date'))
                            ->groupBy('frequency', 'herd_id')
                            ->get();
        
        $dueDate = array();
        $final = array();
        $today = date('Y-m-d');
        
        foreach($imms as $row)
        {
            $dueDate['due_date'] = date('d-m-Y', strtotime(date('Y-m-d', strtotime($row->max_immunized_date)). "+ ".$row->frequency." days"));
            $dueDate['herd_id'] = $row->herd_id;
            array_push($final, $dueDate);
            $dueDate = array();
        }
        
        $field_name = 'due_date';
        
        usort($final, function ($a, $b) use ($field_name) {
            return strtotime($a[$field_name]) - strtotime($b[$field_name]);
        });
        
        foreach($final as $key => $row)
        {
            if(strtotime($row['due_date']) < strtotime($today))
            {
                unset($final[$key]);
            }
        }

        return $final;
    }
    
        
    public function serumIncomplete()
    {
        return Serum::where('status', 'incomplete')->count();
    }
    
    public function serumComplete()
    {
        return Serum::where('status', 'complete')->count();
    }
    
    public function allColors()
    {
        return Color::count();
    }
    
    public function allSOPs()
    {
        return Procedure::where('department_id', 3)->count();
    }
    
    public function allFeeds()
    {
        return Feed::where('species_id', 5)->count();
    }
    
    public function allAdjuvants()
    {
        return Adjuvant::count();
    }
    
    public function inQuarantine()
    {
        return Goat::where('herd_id', [1,2])->count();
    }

}
