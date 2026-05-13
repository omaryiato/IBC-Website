<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CareerApplicationResource;
use App\Services\Dashboard\CareerApplicationService;
use Illuminate\Http\Request;

class CareerApplicationController extends Controller
{
    public function __construct(
        protected CareerApplicationService $careerApplicationService
    ) {}

    public function index()
    {
        $career_applications_list = $this->careerApplicationService->getCareerApplicationsList();

        return ResponseHelper::success(
            CareerApplicationResource::collection($career_applications_list),
            "Careers Returned Successfully.",
            200
        );
    }

    public function show(int $id){
        $career_application_details = $this->careerApplicationService->getCareerApplicationById($id);
        return ResponseHelper::success(
            new CareerApplicationResource($career_application_details),
            "",
            200);
    }
}
