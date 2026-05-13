<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CareerApplicationRepository;

class CareerApplicationService extends BaseService
{
    public function __construct(
        protected CareerApplicationRepository $careerApplicationRepository
    ) {}

    public function getCareerApplicationsList()
    {
        return $this->careerApplicationRepository->getCareerApplicationsList();
    }

    public function getCareerApplicationById(int $id)
    {
        $career_application_details = $this->careerApplicationRepository->getCareerApplicationById($id);
        if (!$career_application_details) {
            return null;
        }
        return $career_application_details;
    }
}
