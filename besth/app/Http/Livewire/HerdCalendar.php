<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Gate;
//use Illuminate\Support\Facades\Route;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Traits\HasRoles;


use App\Models\Event;

class HerdCalendar extends LivewireCalendar
{
    public $events = '';
    
    public $isModalOpen = false;
    public $isModal2Open = false;
    public $selectedEvent = null;

    public $newEvent;
    
    public function events(): Collection
    {
        return Event::query()
            ->whereDate('start_date', '>=', $this->gridStartsAt)
            ->whereDate('start_date', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (Event $model) {
                return [
                    'id' => $model->id,
                    'title' => $model->title,
                    'description' => $model->description,
                    'date' => $model->start_date,
                    'priority' => $model->priority
                ];
            });
    }
    
     public function unscheduledEvents() : Collection
    {
        return Event::query()
            ->whereNull('start_date')
            ->get();
    }

    public function onDayClick($year, $month, $day)
    {
        $this->newEvent['start_date'] = Carbon::today()
          ->setDate($year, $month, $day)
          ->format('Y-m-d');

        if(strtotime($this->newEvent['start_date']) < strtotime(date('Y-m-d')) )
        {
            $this->isModal2Open = true;
        }
        else {
            $this->isModalOpen = true;

            $this->resetNewEvent();
            $this->newEvent['start_date'] = Carbon::today()
                      ->setDate($year, $month, $day)
                      ->format('Y-m-d');
        }
    }

    public function saveEvent()
    {
        $this->newEvent['created_by'] = Auth::user()->name;
        Event::create($this->newEvent);
        $this->isModalOpen = false;
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        $appointment = Weanevent::find($eventId);
        $appointment->start_date = Carbon::today()->setDate($year, $month, $day);
        $appointment->save();
    }

    private function resetNewEvent()
    {
        $this->newEvent = [
            'title' => '',
            'description' => '',
            'start_date' => '',
            'priority' => 'normal',
        ];
    }

    public function onEventClick($eventId)
    {
        $this->selectedEvent = Event::find($eventId);
    }

    public function unscheduleEvent()
    {
        $appointment = Event::find($this->selectedEvent['id']);
        $appointment->start_date = null;
        $appointment->save();

        $this->selectedEvent = null;
    }

    public function closeEventDetailsModal()
    {
        $this->selectedEvent = null;
    }

    public function deleteEvent($eventId)
    {
        $appointment = Event::find($eventId);
        $appointment->delete();
    }

    public function render()
    {
        return parent::render()->with([
            'unscheduledEvents' => $this->unscheduledEvents()
        ]);
    }

}
