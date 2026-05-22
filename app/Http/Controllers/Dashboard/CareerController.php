<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Career\AddNewCareer;
use App\Http\Requests\Career\UpdateCareer;
use App\Http\Resources\CareerResource;
use App\Services\Dashboard\CareerService;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function __construct(
        protected CareerService $careerService
    ) {}

    public function index()
    {
        $careers_list = $this->careerService->getCareersList();

        return ResponseHelper::success(
            CareerResource::collection($careers_list),
            [
                'en' => __('validation.get_careers_list'),
                'ar' => __('validation.get_careers_list'),
            ],
            200
        );
    }

    public function show(int $id){
        $careers_details = $this->careerService->getCareerById($id);

        if (!$careers_details) {
            return ResponseHelper::error(
                $careers_details,
                [
                    'en' => __('validation.career_not_found'),
                    'ar' => __('validation.career_not_found'),
                ],
                404);
        }

        return ResponseHelper::success(
            new CareerResource($careers_details),
            [
                'en' => __('validation.get_career_details'),
                'ar' => __('validation.get_career_details'),
            ],
            200);
    }

    public function store(AddNewCareer $request)
    {
        try{
            $career_details = $this->careerService->addNewCareer($request->all());

            return ResponseHelper::success(
                new CareerResource($career_details),
                [
                    'en' => __('validation.add_new_career'),
                    'ar' => __('validation.add_new_career'),
                ],
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error(
                [
                    'en' => __('validation.exception_error'),
                    'ar' => __('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }

    }

    public function update(UpdateCareer $request, int $id)
    {
        try{
            $career_details = $this->careerService->updateCareer($request->all(), $id);

            if (!$career_details) {
                return ResponseHelper::error(
                    $career_details,
                    [
                        'en' => __('validation.career_not_found'),
                        'ar' => __('validation.career_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                new CareerResource($career_details),
                [
                    'en' => __('validation.update_career'),
                    'ar' => __('validation.update_career'),
                ],
                200);
        } catch(\Exception $exception){
            return ResponseHelper::error(
                [
                    'en' => __('validation.exception_error'),
                    'ar' => __('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }

    public function destroy(int $id){
        try{
            $career_details = $this->careerService->deleteCareer($id);

            if (!$career_details) {
                return ResponseHelper::error(
                    $career_details,
                    [
                        'en' => __('validation.career_not_found'),
                        'ar' => __('validation.career_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                null,
                [
                    'en' => __('validation.delete_career'),
                    'ar' => __('validation.delete_career'),
                ],
                200);
        } catch(\Exception $exception){
            return ResponseHelper::error(
                [
                    'en' => __('validation.exception_error'),
                    'ar' => __('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }

}
