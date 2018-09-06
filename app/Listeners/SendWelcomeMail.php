<?php

namespace App\Listeners;

use App\Mail\WelcomeNewbie;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendWelcomeMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        /**
         * @var User $user
         */
        $user = $event->user;

        $obj = new \stdClass();
        $obj->email = $user->email;
        $obj->name = $user->name;
        Mail::to($obj)->send(new WelcomeNewbie($user));
    }
}
