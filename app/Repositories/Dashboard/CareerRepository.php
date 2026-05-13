<?php

namespace App\Repositories\Dashboard;

use App\Models\Career;
use App\Repositories\Dashboard\BaseRepository;

class CareerRepository
{
    public function getCareerList()
    {
        return Career::with('applications')->get();
    }

    public function getCareerDetails(int $id)
    {
        return Career::with('applications')->findOrFail($id);
    }

    public function addNewCareer(array $career_request)
    {
        return Career::create($career_request);
    }

    public function updateCareer(Career $career, array $career_request)
    {
        $career->update($career_request);
        return $career;
    }

    public function deleteCareer(Career $career)
    {
        return $career->delete();
    }
}
