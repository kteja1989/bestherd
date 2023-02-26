<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserEMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newUser)
    {
        //
        $this->newUser = $newUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->subject('Meissa-BEST: New User Activation Required')
      /*
                            ->attachFromStorage('/path/to/file', 'name.pdf', [
                                'mime' => 'application/pdf'
                            ])
                            */
                            ->view('mailverify.newusermail');
    }
}
