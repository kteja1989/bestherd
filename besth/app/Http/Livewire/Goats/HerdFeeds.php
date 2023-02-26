<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Feed;
use App\Models\Feedsupplier;
use App\Traits\Base;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class HerdFeeds extends Component
{
    use Base;

    //comman variables
    public $feeds;

    //message variables
    public $messagesForm=null;

    public $feed_id, $feed_desc, $feed_speciality, $feed_supplier_id;
    public $supply_date, $quantity, $quantity_unit, $batch_id, $date_mfd, $mfd_date, $received_by;
    public $feedSuppliers;
    
    public function render()
    {
        if( Auth::user()->hasAnyRole(['herdmanager','herdasstimmun','herdasstserum','herdvet']) )
        {
            $this->feeds = Feed::where('species_id', 5)->get();
            $this->feedSuppliers = Feedsupplier::all();
            return view('livewire.goats.herd-feeds')->with(['feeds'=>$this->feeds, 'feedSuppliers'=> $this->feedSuppliers ]);;
        }
        else {
            return view('livewire.permError');
        }
    }

    public function addNewFeed()
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {

            $validatedData = $this->validate(
            [
                'feed_desc'         => 'required|regex:/(^[a-zA-Z0-9-%_. ]+$)+/',
                'feed_speciality'   => 'regex:/(^[a-zA-Z0-9# ]+$)+/',
                'feed_supplier_id'  => 'required|integer',
                'supply_date'       => 'required|date',
                'quantity'          => 'required|regex:/(^[0-9]+$)+/',
                'quantity_unit'     => 'required|regex:/(^[a-zA-Z ]+$)+/',
                'batch_id'          => 'regex:/(^[a-zA-Z0-9-_. ]+$)+/',
                'date_mfd'          => 'date',
                'received_by'       => 'regex:/(^[a-zA-Z0-9-_. ]+$)+/',
            ],
            [
                'feed_desc.required'                => 'Error: The :attribute cannot be empty.',
                'feed_desc.feed_desc'               => 'Error: The :attribute must be letters only.',

                'feed_speciality.required'          => 'Error: The :attribute cannot be empty.',
                'feed_speciality.feed_speciality'   => 'Error: The :attribute must be letters only.',

                'feed_supplier_id.required'         => 'Error: The :attribute cannot be empty.',
                'feed_supplier_id.feed_supplier_id' => 'Error: The :attribute must be letters only.',

                'supply_date.supply_date'           => 'Error: The :attribute must be Date.',

                'quantity.required'                 => 'Error: The :attribute cannot be empty.',
                'quantity.quantity'                 => 'Error: The :attribute must be numbers only.',

                'quantity_unit.required'            => 'Error: The :attribute cannot be empty.',
                'quantity_unit.quantity_unit'       => 'Error: The :attribute must be letters only.',

                'batch_id.batch_id'                       => 'Error: The :attribute must be letters only.',

                'date_mfd.date_mfd'                 => 'Error: The :attribute must be Date.',

                'received_by.received_by'           => 'Error: The :attribute must be letters only.',

            ],
            [
                'feed_desc'        => 'Feed Description',
                'feed_speciality'  => 'Feed Speciality',
                'feed_supplier_id' => 'Feed Supplier Id',
                'supply_date'      => 'Supply Date',
                'quantity'         => 'Quantity',
                'quantity_unit'    => 'Quantity Unit',
                'batch_id'         => 'Batch',
                'date_mfd'        => 'MFD Date',
                'received_by'      => 'Received By',
            ]);


            $addFeed = new Feed();
            $addFeed->species_id = 5;
            $addFeed->description = $this->feed_desc;
            $addFeed->speciality = $this->feed_speciality;
            $addFeed->supplier_id = $this->feed_supplier_id;
            $addFeed->supply_date = $this->supply_date;
            $addFeed->quantity = $this->quantity;
            $addFeed->quantity_unit = $this->quantity_unit;
            $addFeed->batch = $this->batch_id;
            $addFeed->mfd_date = $this->date_mfd;
            $addFeed->received_by = $this->received_by;
            //dd($addFeed);
            $addFeed->save();

            $this->feed_desc        = null;
            $this->feed_speciality  = null;
            $this->feed_supplier_id = null;
            $this->supply_date      = null;
            $this->quantity         = null;
            $this->quantity_unit    = null;
            $this->batch_id         = null;
            $this->date_mfd         = null;
            $this->received_by      = null;

        }
		else {
		    return view('livewire.permError');
		}
    }

    public function deleteColor($feed_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            //dd($color_id);
            $result = Feed::where('feed_id', $feed_id)->delete();
        }
    }

}
