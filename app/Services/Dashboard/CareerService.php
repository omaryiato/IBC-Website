<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CareerRepository;

class CareerService extends BaseService
{
    public function __construct(
        protected CareerRepository $careerRepository
    ) {}

    public function getCareersList()
    {
        return $this->careerRepository->getCareersList();
    }

    public function getCareerById(int $id)
    {
        $career_details = $this->careerRepository->getCareerById($id);
        if (!$career_details) {
            return null;
        }
        return $career_details;
    }

    public function addNewCareer(array $career_request)
    {
        return $this->careerRepository->addNewCareer($career_request);
    }

    public function updateCareer(array $career_request, int $id)
    {
        $career_details = $this->careerRepository->getCareerById($id);
        if (!$career_details) {
            return null;
        }
        return $this->careerRepository->updateCareer($career_details, $career_request);
    }
    public function deleteCareer(int $id)
    {
        $career_details = $this->careerRepository->getCareerById($id);
        if (!$career_details) {
            return null;
        }
        return $this->careerRepository->deleteCareer($career_details);
    }
}
