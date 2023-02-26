<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Dailyherdrecord;
use App\Models\Procedure;
use App\Models\Sop;

use App\Traits\Base;
use App\Traits\DashTempHumidityGraphTrait;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class DailyRecords extends Component
{
    use DashTempHumidityGraphTrait;
    
    //landing page variables
    public $drecords, $final;

    public $sops, $temperature, $humidity;
    
    public $xth, $temp, $humid, $lwMessage;
    
    //listeners
    protected $listeners = [
        'emitDrawTHGraphs' => 'passToTempHumidGraph',
        'refreshComponent' => '$refresh'
    ];
    
    //form variables
    public $sop_idx, $herd_id, $tempx, $humidx, $dry_cleaned;
    public $water_cleaned, $special_cleaned, $remarks, $supervised_by;

    public function render()
    {
        $this->final = $this->processTempHumidGraphData();
        $this->drecords = $this->final['drecords'];
        $this->sops = Sop::where('department_id', 3)->get();
        return view('livewire.goats.daily-records');
    }
    
    public function passToTempHumidGraph()
    {
        $this->setTempHumidGraphValues();
    }

    public function addNewDR()
    {
        
        $validatedData = $this->validate(
        [   
            'sop_idx'        =>   'required|integer|between:1, 100',
            'herd_id'         => 'required|integer|between:1,25',
            'tempx'           => 'required|numeric|between:4,55',
            'humidx'          => 'required|numeric|between:4,100',
            'special_cleaned' => 'regex:/^[A-Za-z0-9-_,. ]+$/|nullable',
            'remarks'         => 'regex:/^[A-Za-z0-9-_,. ]+$/|nullable',
            'supervised_by'   => 'regex:/^[A-Za-z. ]+$/'
        ],
        [
           'sop_idx.required'                  => 'Error: The :attribute cannot be empty.',
           'sop_idx.sop_idx'                    => 'Error: The :attribute must be selected.',
            'herd_id.required'                => 'Error: The :attribute cannot be empty.',
            'herd_id.herd_id'                 => 'Error: The :attribute must be Numbers only.',
            'tempx.required'                  => 'Error: The :attribute cannot be empty.',
            'tempx.tempx'                     => 'Error: The :attribute must be Number only.',
            'humidx.required'                 => 'Error: The :attribute cannot be empty.',
            'humidx.humidx'                   => 'Error: The :attribute must be Number only.',
            'special_cleaned.special_cleaned' => 'Error: The :attribute must be Letters and Dash only.',
            'remarks.remarks'                 => 'Error: The :attribute must be Letters and Dash only.',
            'supervised_by.supervised_by'     => 'Error: The :attribute must be Letters only.',
        ],
        [
            'sop_idx'          => 'SOP',
            'herd_id'         => 'Herd ID',
            'tempx'           => 'Temperature',
            'humidx'          => 'Humidity',
            'special_cleaned' => 'Special Cleaning',
            'remarks'         => 'Remarks',
            'supervised_by'   => 'Supervisor Name'
        ]);

        $newDR = new Dailyherdrecord();
        $newDR->sop_id = $this->sop_idx;
        $newDR->entry_date = date('Y-m-d');
        $newDR->herd_id = $this->herd_id;
        $newDR->temperature = $this->tempx;
        $newDR->humidity = $this->humidx;
        $newDR->dry_cleaned = $this->dry_cleaned;
        $newDR->water_cleaned = $this->water_cleaned;
        $newDR->special = $this->special_cleaned;
        $newDR->remarks = $this->remarks;
        $newDR->carried_by = Auth::user()->name;
        $newDR->supervised_by = $this->supervised_by;
        //dd($newDR);
        $newDR->save();
        // now get the updated graph data
        $this->final = $this->processTempHumidGraphData();
        $this->setTempHumidGraphValues();
        $this->resetDrForm();
    }
    
    //now dispatch the browser event
    public function setTempHumidGraphValues()
    {
      $this->dispatchBrowserEvent('drawTHGraphs', [
        'xth' => $this->final['xth'],
        'temp' => $this->final['temp'],
        'humid' => $this->final['humid']
      ]);
    }    

    public function resetDrForm()
    {
        $this->sop_idx = null;
        $this->herd_id = null;
        $this->tempx = null;
        $this->humidx = null;
        $this->dry_cleaned = null;
        $this->water_cleaned = null;
        $this->special_cleaned = null;
        $this->remarks = null;
        $this->supervised_by = null;
    }
}
