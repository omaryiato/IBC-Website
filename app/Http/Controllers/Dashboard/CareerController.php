<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\CareerResource;
use App\Services\Dashboard\CareerService;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function __construct(
        protected CareerService $careerService
    ) {}

    public function index()
    {
        $careers_list = $this->careerService
                ->getCareersList();

        return ResponseHelper::success(
            CareerResource::collection($careers_list),
            "Careers Returned Successfully.",
            200
        );
    }

    public function show(int $id){
        $careers_details = $this->careerService->getCareerById($id);
        return ResponseHelper::success(
            new CareerResource($careers_details),
            "",
            200);
    }

    public function store(Request $request)
    {
        try{
            $career_details = $this->careerService
            ->createCareer($request->all());

            return ResponseHelper::success(
                new CareerResource($career_details),
                "Career created Successfully.",
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }

    public function update(Request $request, int $id)
    {
        try{
            $career_details = $this->careerService->updateCareer($id, $request->all());
            return ResponseHelper::success(
                new CareerResource($career_details),
                "",
                200);
        } catch(\Exception $exception){
            return ResponseHelper::error("", $exception->getMessage(), 500);
        }
    }

    public function destroy(int $id){
        try{
            $this->careerService->deleteCareer($id);
            return ResponseHelper::success(null,"",200);
        } catch(\Exception $exception){
            return ResponseHelper::error("", $exception->getMessage(), 500);
        }
    }

}
