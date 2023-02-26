<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

use App\Models\Immunedgoats;
use App\Models\Immunization;

class ShowImmunizations extends ModalComponent
{
    public $name = "Meissa-BEST";

    public $immdata, $herd_id, $goat_id, $immunization_id;

    public $title = "Immunization Details";

    public function render()
    {
        /*
        $this->immdata = Immunedgoats::with('immunztion')
                                    ->where('goat_id', $this->goat_id)
                                    ->get();
        */                            
        $this->immdata = Immunization::with('sop')
                            ->where('immunization_id', $this->immunization_id)
                                    ->get();    
        return view('livewire.show-immunizations');
    }

    public function close()
    {
      $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}