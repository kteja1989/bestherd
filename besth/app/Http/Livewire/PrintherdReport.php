<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PrintherdReport extends ModalComponent
{
    public $name = "Some Test Name";

    public $fromDate, $toDate, $qr;

    public $title = "Title of the modal";

    public function render()
    {
        return view('livewire.printherd-report');
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
