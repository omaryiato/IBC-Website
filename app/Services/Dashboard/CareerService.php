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
        return $this->careerRepository->addNewCareer($this->prepareCareerDetails($career_request));
    }

    public function updateCareer(array $career_request, int $id)
    {
        $career_details = $this->careerRepository->getCareerById($id);
        if (!$career_details) {
            return null;
        }
        $career_request = $this->prepareCareerDetails($career_request);
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

    public function prepareCareerDetails(array $career_request) : array
    {

        $data =  [
            'title' => json_decode($career_request['title'], true) ?? null,
            'description' => json_decode($career_request['description'], true) ?? null,
            'requirements' => json_decode($career_request['requirements'], true) ?? null,
            'employment_type' => $career_request['employment_type'],
            'location' => $career_request['location'],
            'deadline' => $career_request['deadline'],
            'is_active' => $career_request['is_active'],
        ];

        if (isset($career_request['created_by'])) {
            $data['created_by'] = $career_request['created_by'];
        }

        if (isset($career_request['updated_by'])) {
            $data['updated_by'] = $career_request['updated_by'];
        }

        return $data;
    }
}
