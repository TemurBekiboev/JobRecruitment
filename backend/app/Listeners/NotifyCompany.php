<?php

namespace App\Listeners;

use App\Events\ApplicationCreated;
use App\Jobs\SendApplicationEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyCompany
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ApplicationCreated $event): void
    {
        SendApplicationEmailJob::dispatch($event->application);
    }
}
