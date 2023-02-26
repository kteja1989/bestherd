<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

use App\Models\Health;
use App\Models\Goathealth;

class HealthModal extends ModalComponent
{
    public $name = "Meissa-BEST";

    public $herdHealth, $goatHealth, $herd_id, $goat_id;

    public $title = "Health Details";

    public function render()
    {
        $this->goatHealth = Goathealth::with('sops')->where('goat_id', $this->goat_id)->get();   
        
        $this->herdHealth = Health::with('sops')
                          ->where('herd_id', $this->herd_id)
                          ->latest('inspected_on')->first();
                         
        return view('livewire.health-modal');
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
