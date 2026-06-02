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
            [
                'en' => trans('validation.get_career_applications_list'),
                'ar' => trans('validation.get_career_applications_list'),
            ],
            200
        );
    }

    public function show(int $id){
        $career_application_details = $this->careerApplicationService->getCareerApplicationById($id);

        if (!$career_application_details) {
            return ResponseHelper::error(
                $career_application_details,
                [
                    'en' => trans('validation.career_application_not_found'),
                    'ar' => trans('validation.career_application_not_found'),
                ],
                404);
        }

        return ResponseHelper::success(
            new CareerApplicationResource($career_application_details),
            [
                'en' => trans('validation.get_career_application_details'),
                'ar' => trans('validation.get_career_application_details'),
            ],
            200);
    }
}
