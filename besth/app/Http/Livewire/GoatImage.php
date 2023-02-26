<?php

namespace App\Http\Livewire;


use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

use App\Models\Goatsera;
use App\Models\Serum;
use App\Models\Mugshot;


class GoatImage extends ModalComponent
{
    public $name = "Meissa-BEST";

    public $goatImage, $modalImage, $path, $image_id, $herd_id, $goat_id;

    public $title = "Goat Image";
    
    public function render()
    {
        $this->modalImage = Mugshot::where('mugshot_id', $this->image_id)->first();
        return view('livewire.goat-image');
    }
    
    public function close()
    {
      $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
    
}
