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
        return $this->careerRepository->all();
    }

    public function getCareerById(int $id)
    {
        $career_details = $this->careerRepository->findOrFail($id);
        if (!$career_details) {
            return null;
        }
        return $career_details;
    }

    public function createCareer(array $career_request)
    {
        return $this->careerRepository->create($career_request);
    }

    public function updateCareer(int $id, array $career_request)
    {
        return $this->careerRepository->update($id, $career_request);
    }
    public function deleteCareer(int $id)
    {
        return $this->careerRepository->delete($id);
    }
}
