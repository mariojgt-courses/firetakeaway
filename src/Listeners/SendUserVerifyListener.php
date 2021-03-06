<?php

namespace Mariojgt\Firetakeaway\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mariojgt\Firetakeaway\Mail\UserVerifyEmail;
use Mariojgt\Firetakeaway\Events\UserVerifyEvent;

class SendUserVerifyListener
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
     * @param  UserVerifyEvent  $event
     * @return void
     */
    public function handle(UserVerifyEvent $event)
    {
        Mail::to($event->user)->send(new UserVerifyEmail($event->user));
    }
}
