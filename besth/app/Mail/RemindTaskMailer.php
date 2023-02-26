<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindTaskMailer extends Mailable
{
    use Queueable, SerializesModels;
    public $events;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $events)
    {
        //
        $this->events = $events;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->subject('Meissa-BEST Reminder Mail: Event Dates for '.$this->name)
                              ->view('taskmailers.duedatemail');
    }
}
