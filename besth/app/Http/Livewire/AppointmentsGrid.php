<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Gate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Route;

use Asantibanez\LivewireResourceTimeGrid\LivewireResourceTimeGrid;
use Illuminate\Support\Collection;
use Carbon\Carbon;

use App\Models\Project;
use App\Models\Assent;
use App\Models\Task;
use App\Models\Department;
use App\Models\Event;

use App\Traits\Base;

use Validator;

class AppointmentsGrid extends LivewireResourceTimeGrid
{
    use Base;

    public $taskText, $category, $lwMessage;

    public $hour, $slot, $event, $eventId, $resourceId;

    public $unscheduledEvents = [];

    public $events;

    //pabel Modals
    public $isModalOpen = false;
    public $isModal2Open = false;
    public $selectedEvent = false;

    public function resources(): Collection
    {
        // must return a Laravel collection
        return Department::all()
            ->map(function (Department $model) {
                return [
                    'id' => $model->department_id,
                    'title' => $model->name,
                ];
            });
        /*
        return collect([
          ['id' => 1, 'title' => 'Self Tasks'],
          ['id' => 2, 'title' => 'Herds Dept'],
          ['id' => 3, 'title' => 'Maitenance'],
          ['id' => 4, 'title' => 'Management'],
          ['id' => 5, 'title' => 'Data Staff'],
        ]);
        */
    }

    public function events(): Collection
    {
        // must return a Laravel collection
        $today = date('Y-m-d');
        return Event::query()
            ->whereDate('start_date', '=', $today)
            ->get()
            ->map(function (Event $model) {
                return [
                    'id' => $model->id,
                    'title' => $model->title,
                    'description' =>$model->description,
                    'starts_at' => Carbon::today()->setTime($model->start_hour, $model->start_min),
                    'ends_at' => Carbon::today()->setTime($model->end_hour, $model->end_min),
                    'resource_id' => $model->resource_id,
                ];
            });
        /*
        $start_hour = '10';
        $start_min = '0';
        $end_hour = '11';
        $end_min = '30';
        return collect([
          [
              'id' => 1,
              'title' => 'Meeting',
              'starts_at' => Carbon::today()->setTime($start_hour, $start_min),
              'ends_at' => Carbon::today()->setTime($end_hour, $end_min),
              'resource_id' => 1,
          ],
          [
              'id' => 2,
              'title' => 'Inspection',
              'starts_at' => Carbon::today()->setTime(14, 0),
              'ends_at' => Carbon::today()->setTime(16, 0),
              'resource_id' => 3,
          ],
        ]);
        */
    }

    public function hourSlotClick($resourceId, $hour, $slot)
    {
        // This event is triggered when a time slot is clicked.//
        // You'll get the resource id as well as the hour and minute
        // clicked by the user
    }

    public function onEventClick($event)
    {
        // This event will fire when an event is clicked. You will get the event that was
        // clicked by the user
    }

    public function onEventDropped($eventId, $resourceId, $hour, $slot)
    {
        // This event will fire when an event is dragged and dropped into another time slot
        // You will get the event id, the new resource id + hour + minute where it was
        // dragged to
    }

    public function markAsDone($id)
  	{
    		$task = Task::where('task_id', $id)
    									->where('self_id', Auth::id())
    									->first();
    		$task->status = 'Done';
    		$task->save();
    		$this->lwMessage = "Status updated";
  	}

  	public function saveTask()
  	{
    		$newTask = new Task();

    		$newTask->self_id = Auth::id();
    		$newTask->category = $this->category;
    		$newTask->text = $this->taskText;
    		$newTask->date = date('Y-m-d');
    		$newTask->status = 'Active';
    		$newTask->save();
    		$this->resetTaskForm();

  	}

  	public function resetTaskForm()
  	{
    		$this->category = "";
    		$this->taskText = "";
  	}
}
