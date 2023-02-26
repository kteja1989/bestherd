<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class HerdAdministration extends Component
{
    public function render()
    {
        return view('livewire.goats.herd-administration');
    }
}
