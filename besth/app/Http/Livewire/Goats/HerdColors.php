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
use App\Traits\Base;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class HerdColors extends Component
{
    use Base;
        
    //comman variables
    public $colors;

    //message variables
    public $messagesForm=null;
    
    public $color_name, $color_id, $html_code, $hex_code;
    
    public function render()
    {
        if( Auth::user()->hasAnyRole(['herdmanager','herdasstimmun','herdasstserum','herdvet']) )
        {
            $this->colors = Color::all();
            return view('livewire.goats.herd-colors')->with(['colors'=>$this->colors]);;
        }
        else {
            return view('livewire.permError');
        }
    }
    
    public function addNewColor()
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            
            $validatedData = $this->validate(
            [  
                'color_name' => 'required|alpha',
                'hex_code'   => 'regex:/(^[a-zA-Z0-9# ]+$)+/',
            ],
            [
                'color_name.required'   => 'Error: The :attribute cannot be empty.',
                'color_name.color_name' => 'Error: The :attribute must be letters only.',
                'hex_code.hex_code'     => 'Error: The :attribute must be letters only.',
            ],
            [ 
                'color_name' => 'Herd Color',
                'hex_code'   => 'Hex Code',
            ]);
            
            
            $addColor = new Color();
            $addColor->color_name = $this->color_name;
            $addColor->hex_code = $this->hex_code;
            //dd($addColor);
            $addColor->save();
            
            $this->color_name = null;
            $this->hex_code = null;
        }
		else {
		    return view('livewire.permError');
		}
    }
    
    public function deleteColor($color_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            //dd($color_id);
            $result = Color::where('color_id', $color_id)->delete();
        }
    }
    
}
