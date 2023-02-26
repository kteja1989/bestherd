<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ConfirmModal extends ModalComponent
{
    public $message, $reply, $deleteTempgoatRows;

    public function render()
    {
        return view('livewire.confirm-modal');
    }

    public function confirmed()
    {
        $this->emit('deleteTempgoatRows');
        $this->closeModal();
    }

    public function cancelled()
    {
      $this->emit('replyListener',
                  [
                    "reply" => "no",
                  ]);
      $this->closeModal();
    }

    public function close()
    {
      $this->closeModal();
    }

    /**
   * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
   */
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
