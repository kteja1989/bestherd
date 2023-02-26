<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Species;
use App\Models\Department;
use App\Models\Supply;
use App\Models\Feedsupplier;

use App\Traits\Base;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class FeedSuppliers extends Component
{
    use Base;

    //landing page variables
    public $feedSuppliers, $species;

    public $lwMessage;

    //form variables
    public $supp_name, $supp_address, $supp_contact1, $supp_contact2, $supp_email, $supp_notes;
    public $feed_species;
    
    public function render()
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            $this->feedSuppliers = Feedsupplier::with('species')->get();
            $this->species = Species::all();
            return view('livewire.goats.feed-suppliers');
        }
        else {
            return view('livewire.permError');
        }
    }
    
    public function saveFeedSupplier()
    {
        $validatedData = $this->validate(
        [   'supp_name'     => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'feed_species'  => 'required|integer',
            'supp_address'  => 'required|string|regex:/^[A-Za-z0-9,-_. ]+$/',
            'supp_contact1' => 'required|string|regex:/^[0-9- ]+$/',
            'supp_contact2' => 'nullable|string|regex:/^[0-9- ]+$/',
            'supp_email'    => 'nullable|email',
            'supp_notes'    => 'nullable|string|regex:/^[A-Za-z0-9-,_. ]+$/',
        ],
        [
            'supp_name.required'          => 'Error: The :attribute cannot be empty.',
            'supp_name.supp_name'         => 'Error: The :attribute must be letters only.',
            
            'feed_species.required'       => 'Error: The :attribute cannot be empty.',
            'feed_species.feed_species'   => 'Error: The :attribute must be selected.',
            
            'supp_address.required'       => 'Error: The :attribute cannot be empty.',
            'supp_address.supp_address'   => 'Error: The :attribute must be letters only.',
            'supp_contact1.required'      => 'Error: The :attribute cannot be empty.',
            'supp_contact1.supp_contact1' => 'Error: The :attribute must be letters only.',
            'supp_contact2.required'      => 'Error: The :attribute cannot be empty.',
            'supp_contact2.supp_contact2' => 'Error: The :attribute must be Numbers only.',
            //'supp_email.required'       => 'Error: The :attribute cannot be empty.',
            'supp_email.supp_email'       => 'Error: The :attribute must be Letters and Dash only.',
            //'supp_notes.required'       => 'Error: The :attribute cannot be empty.',
            'supp_notes.supp_notes'   => 'Error: The :attribute must be Letters and Dash only.',
        ],
        [
            'supp_name'     => 'Supplier Name',
            'feed_species'  => 'Species',
            'supp_address'  => 'Supplier Address',
            'supp_contact1' => 'Primary Contact Number',
            'supp_contact2' => 'Second Contact Number',
            'supp_email' => 'Email',
            'supp_notes' => 'Notes Remarks if any',
        ]);
        
        $newFs = new Feedsupplier();
        $newFs->name = $this->supp_name;
        $newFs->species_id = $this->feed_species;
        $newFs->address = $this->supp_address;
        $newFs->contact1 = $this->supp_contact1;
        $newFs->contact2 = $this->supp_contact2;
        $newFs->email = $this->supp_email;
        $newFs->notes = $this->supp_notes;
        $newFs->posted_by = Auth::user()->name;
        $newFs->status = "active";
        //dd($newFs);
        $newFs->save();
        
        $this->resetForm();
        
    }
    
    public function resetForm()
    {
        $this->supp_name = null;
        $this->feed_species = null;
        $this->supp_address = null;
        $this->supp_contact1 = null;
        $this->supp_contact2 = null;
        $this->supp_email = null;
        $this->supp_notes = null;
    }
}
