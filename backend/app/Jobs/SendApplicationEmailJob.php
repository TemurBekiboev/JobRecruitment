<?php

namespace App\Jobs;

use App\Models\Application;
use App\Notifications\CandidateAppliedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendApplicationEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Application $application)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $company = $this->application->vacancy->company->user;

        $company->notify(new CandidateAppliedNotification($this->application));
    }
}
