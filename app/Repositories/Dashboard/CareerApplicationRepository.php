<?php

namespace App\Repositories\Dashboard;

use App\Models\CareerApplication;
use App\Repositories\Dashboard\BaseRepository;

class CareerApplicationRepository
{
    public function getCareerApplicationsList()
    {
        return CareerApplication::with('career')->get();
    }

    public function getCareerApplicationById(int $id)
    {
        return CareerApplication::with('career')->findOrFail($id);
    }
}
