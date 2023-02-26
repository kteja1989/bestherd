<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Color;
use App\Models\Adjuvant;

use App\Traits\Base;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageAdjuvants extends Component
{
    use Base;
        
    //comman variables
    public $adjuvants;

    //message variables
    public $messagesForm=null;
    
    public $adjuvant_name, $nick_name, $volume, $volume_unit, $manufacturer;
    
    public function render()
    {
        if( Auth::user()->hasAnyRole(['herdmanager','herdasstimmun','herdasstserum','herdvet']) )
        {
            $this->adjuvants = Adjuvant::all();
            return view('livewire.goats.manage-adjuvants')->with(['adjuvants'=>$this->adjuvants]);;
        }
        else {
            return view('livewire.permError');
        }
    }
    
    public function addNewAdjuvant()
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            
            $validatedData = $this->validate(
            [  
                'adjuvant_name' => 'required|regex:/(^[a-zA-Z0-9-_ ]+$)+/',
                'nick_name'     => 'regex:/(^[a-zA-Z0-9-_ ]+$)+/',
                'volume'        => 'required|regex:/(^[a-zA-Z0-9 ]+$)+/',
                'volume_unit'   => 'required|regex:/(^[a-zA-Z ]+$)+/',
                'manufacturer'  => 'required|regex:/(^[a-zA-Z0-9-_,. ]+$)+/',
            ],
            [
                'adjuvant_name.required'   => 'Error: The :attribute cannot be empty.',
                'adjuvant_name.adjuvant_name' => 'Error: The :attribute must be letters only.',
                
                'nick_name.required'   => 'Error: The :attribute cannot be empty.',
                'nick_name.nick_name' => 'Error: The :attribute must be letters only.',
                
                'volume.required'   => 'Error: The :attribute cannot be empty.',
                'volume.volume' => 'Error: The :attribute must be letters only.',
                
                'volume_unit.required'   => 'Error: The :attribute cannot be empty.',
                'volume_unit.volume_unit' => 'Error: The :attribute must be letters only.',
                
                'manufacturer.required'   => 'Error: The :attribute cannot be empty.',
                'manufacturer.manufacturer' => 'Error: The :attribute must be letters only.',
            ],
            [ 
                'adjuvant_name' => 'Adjuvant Name',
                'nick_name'     => 'Nick Name',
                'volume'        => 'Volume',
                'volume_unit'   => 'Volume Unit',
                'manufacturer'  => 'Manufacturer',
                
            ]);
            
            
            $addAdjuvant = new Adjuvant();
            $addAdjuvant->adjuvant_name = $this->adjuvant_name;
            $addAdjuvant->nick_name = $this->nick_name;
            $addAdjuvant->volume = $this->volume;
            $addAdjuvant->volume_unit = $this->volume_unit;
            $addAdjuvant->manufacturer = $this->manufacturer;
            //dd($addAdjuvant);
            $addAdjuvant->save();
            
            $this->adjuvant_name = null;
            $this->nick_name = null;
            $this->volume = null;
            $this->volume_unit = null;
            $this->manufacturer = null;

        }
		else {
		    return view('livewire.permError');
		}
    }
    
    public function deleteAdjuvant($adjuvant_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            //dd($adjuvant_id);
            $result = Color::where('adjuvant_id', $adjuvant_id)->delete();
        }
    }
}
