<?php

namespace App\Jobs;

use App\Models\CareerApplication;
use App\Mail\JobApplicationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendJobApplicationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $application_id) {}

    public function handle()
    {
        $application = CareerApplication::find($this->application_id);

        if (!$application) {
            return;
        }

        // Mail::to('hr@company.com')->send(new JobApplicationMail($application));
    }
}
