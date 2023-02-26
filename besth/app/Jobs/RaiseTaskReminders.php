<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Immunization;
use App\Models\Event;

use Mail;
use App\Mail\RemindTaskMailer;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use App\Traits\TaskReminderTrait;

class RaiseTaskReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use TaskReminderTrait;

    /** @var Tenant */
    protected $tenant;

    protected $eventDueDates;

    protected $events;

    protected $users;

    protected $mailInfo;

    public $emailTo;

    public $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tenant)
    {
        //
        $this->tenant = $tenant;
        //$this->events = $events;
        //$this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->tenant->run(function ($tenant) {
                    
            $count = 0;
            $fcount = 0;
                    
            $today = date('Y-m-d');
            $tomorrow = date('Y-m-d', strtotime("+1 day", strtotime($today)));
            $within2days = date('Y-m-d', strtotime('+2 days', strtotime($today)));
    
            $events = Event::where('start_date','<=', $within2days)
                            ->where('start_date','>=', $today)->get();
    
            $users = User::where('role', 'pisg')->get();
    
            Log::channel('tenantjobs')->info('counts .', ['event count'=> count($events), 'user count'=> count($users) ]);
                
            $this->events = $events;
                    
            //$users = array(); //kill this line in live
            
            if(count($events) > 0)
            {
                if(count($users) > 0) 
                {
                    foreach($users as $user)
                    {
                        //if($user->email == "mvksastry@gmail.com")
                        //{
                            $this->name = $user->name;
                            Mail::to($user->email)->send(new RemindTaskMailer($this->name, $this->events));
                            
                            if (Mail::failures())
                            {
                                $count = $count + 1;
                                Log::channel('tenantjobs')->error($this->name." ; ".$user->email.' Email send failed.', ['count' => $count, 'email' => $user->email ]);
                            }else{
                                $count = $count + 1;
                                Log::channel('tenantjobs')->info($this->name." ; ".$user->email.' Email send Success.', ['count' => $count, 'email' => $user->email ]);
                            }
                        //}
                        //else{
                        //    $fcount = $fcount + 1;
                        //    Log::channel('tenantjobs')->info(' Mail not sent to User ', ['email' => $user->email, 'failed count' => $fcount  ]);
                        //}
                    }
                }
                else {
                    $fcount = $fcount + 1;
                    Log::channel('tenantjobs')->info(' User not Found for Tenant Id :'. tenant('id'));
                }
            }
            else {
                Log::channel('tenantjobs')->info(' Events not Found for Tenant Id :'. tenant('id'));
            }
        });
    }
}
