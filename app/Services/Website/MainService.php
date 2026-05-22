<?php

namespace App\Services\Website;

use App\Repositories\Website\MainRepository;
use Illuminate\Support\Facades\File;

class MainService
{
    public function __construct(
        protected MainRepository $mainRepository
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

        if (!empty($application_request['cv_file'])) {
            $this->uploadCvFile(
                $application_request['cv_file'],
                $prepared_application['cv_file'],
                $application_request['career_id']
            );
        }

        return $application_details;
    }

    public function prepareApplicationRequest(array $application_request): array
    {
        $applicant_name = str_replace(' ', '_', $application_request['full_name']);

        $extension = $application_request['cv_file']
            ->getClientOriginalExtension();

        $cv_file_name = "{$applicant_name}_CV.{$extension}";

        $cv_file_path = public_path("documents/careers/job_application_{$application_request['career_id']}/{$cv_file_name}");

        return [
            'career_id' => $application_request['career_id'],
            'full_name' => $application_request['full_name'],
            'email' => $application_request['email'],
            'phone' => $application_request['phone'],
            'cv_file' => $cv_file_path,
            'message' => $application_request['message'],
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
}
