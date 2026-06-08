<?php

namespace App\Helpers;

use App\Mail\JobApplicationMail;
use App\Models\CareerApplication;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class JobApplicationHelper
{


    public function JobApplicationNotification(int $application_id)
    {

        try {

            $application_details = CareerApplication::with('career')->findOrFail($application_id);

            $view_name = 'emails.job_application';
            $subject = 'Job Applications: New Job Application';

            $email_address = 'oalkhateeb1710@gmail.com';
            // $email_address = 'o.bsharat@beveconsult.com';
            // $email_address = $email_ditals['mail_to'];

            $data = [
                'header' => "IBC Group",
                'title' => "New Job Application",
            ];

            if (!empty($email_address)) {
                $emailSent = Mail::to($email_address)->send(new JobApplicationMail($application_details, $view_name, $subject));
                return $emailSent;
            } else {
                // Log::channel('sendnotification')->debug("error->");
                return false;
            }

        } catch (\Exception $exception) {
            // Log::channel('sendnotification')->debug($exception);
            throw $exception;
        }

    }


}
