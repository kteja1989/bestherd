<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

use App\Models\Goatsera;
use App\Models\Serum;


class PlasmaDetails extends ModalComponent
{
    public $name = "Meissa-BEST";

    public $plasmaData, $herd_id, $goat_id, $serum_id;

    public $title = "Immunization Details";

    public function render()
    {
        $this->plasmaData = Serum::with('sops')
                          ->where('serum_id', $this->serum_id)
                          ->get();
        return view('livewire.plasma-details');
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
