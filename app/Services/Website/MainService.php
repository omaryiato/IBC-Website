<?php

namespace App\Services\Website;

use App\Jobs\SendJobApplicationEmailJob;
use App\Helpers\JobApplicationHelper;
use App\Repositories\Website\MainRepository;
use Illuminate\Support\Facades\File;

class MainService
{
    public function __construct(
        protected MainRepository $mainRepository,
        protected JobApplicationHelper $jobApplicationHelper
    ) {}

    public function getActivePagesList()
    {
        return $this->mainRepository->getActivePagesList();
    }

    public function getPublishedBlogsList()
    {
        return $this->mainRepository->getPublishedBlogsList();
    }

    public function getActiveCareersList()
    {
        return $this->mainRepository->getActiveCareersList();
    }

    public function applyJobApplication(array $application_request)
    {
        $prepared_application = $this->prepareApplicationRequest($application_request);

        $application_details = $this->mainRepository
            ->ApplyJobApplication($prepared_application);

        if (!$application_details?->id) {
            throw new \Exception('Application creation failed');
        }

        if (!empty($application_request['cv_file'])) {
            $this->uploadCvFile(
                $application_request['cv_file'],
                $prepared_application['cv_file'],
                $application_request['career_id']
            );
        }

        $this->jobApplicationHelper->JobApplicationNotification($application_details);
        // SendJobApplicationEmailJob::dispatch($application_details->id);

        return $application_details;
    }

    public function prepareApplicationRequest(array $application_request): array
    {
        $applicant_name = str_replace(' ', '_', $application_request['full_name']);

        $extension = $application_request['cv_file']
            ->getClientOriginalExtension();

        $cv_file_name = "{$applicant_name}_CV.{$extension}";

        $cv_file_path = "documents/careers/job_application_{$application_request['career_id']}/{$cv_file_name}";

        return [
            'career_id' => $application_request['career_id'],
            'full_name' => $application_request['full_name'],
            'email' => $application_request['email'],
            'phone' => $application_request['phone'],
            'cv_file' => $cv_file_path,
            'message' => $application_request['message'],
            'created_at' => now(),
        ];
    }

    public function uploadCvFile($cv_file, string $cv_file_name, int $career_id)
    {
        $cv_file_path = public_path("documents/careers/job_application_{$career_id}");

        if (!File::exists($cv_file_path)) {
            File::makeDirectory($cv_file_path, 0755, true);
        }

        return $cv_file->move($cv_file_path, $cv_file_name);
    }

    public function ContactUs(array $message_request)
    {
        return $this->mainRepository->ContactUs($message_request);

    }

    // sendNotification Funtion To Send Notification by email and sms
    // public function sendNotification(array $notification_details )
    // {

    //     try {

    //         $qiwa_eos_request_id= $notification_details['qiwa_eos_request_id'];
    //         $next_approver_number = $notification_details['next_approver_number'];
    //         $login_user = $notification_details['login_user'];
    //         $type = $notification_details['type'];
    //         $message = $notification_details['message'];

    //         // Check if theres a next approver or not

    //         if (isset($next_approver_number)) {


    //             // Get person ID

    //             $person_id = $this->contactInfoProvider->GetPersonID($next_approver_number);


    //             // Get employee phone number
    //             $phone_number = $this->contactInfoProvider->GetPhoneEmpFromPersonId($person_id);


    //             // Get employee phone number
    //             $email_address = $this->contactInfoProvider->GetEmailEmployee($next_approver_number);



    //             $notification_details['mail_to'] = $email_address?->email;
    //             $notification_details['next_approver_name'] = $email_address->full_name ?? null;


    //             // Initialize status tracking
    //             $smsSent = false;
    //             $emailSent = false;

    //             // Send SMS message for approval num

    //             // Try to send SMS
    //             // try {
    //             //     // Send SMS message for approval num

    //             //     if($notification_details['role'] != 6){
    //             //         // $smsSent = $this->smsVerifyHelper->sendSMS($phone_number, $message);
    //             //     }

    //             //     // Check if message sent or not

    //             //     if ($smsSent) {
    //             //     } else {
    //             //     }
    //             // } catch (\Exception $exception) {
    //             // }


    //             // Try to send email
    //             try {
    //                 if($type == 'Approver'){
    //                     $emailSent = $this->approverEmailHelper->sendApproverNotify($notification_details);
    //                 } else {
    //                     $emailSent = $this->approverEmailHelper->sendOwnerNotify($notification_details);
    //                 }

    //             } catch (\Exception $exception) {
    //             }


    //             // Check the overall status and handle accordingly
    //             if (!$emailSent) {
    //                 $status = [
    //                     // 'sms' => $smsSent ? 'success' : 'failure',
    //                     'email' => $emailSent ? 'success' : 'failure',
    //                 ];
    //                 return "failure";
    //             }


    //             return "Done";
    //         } else {
    //             return "warning";
    //         }
    //     } catch (\Exception $exception) {
    //         throw $exception;
    //     }
    // }


}
