<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Services\Dashboard\SectionService;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct(
        protected SectionService $sectionService
    ) {}

    public function index()
    {
        $sections_list = $this->sectionService
            ->getSectionsList();

        return ResponseHelper::success(
            SectionResource::collection($sections_list),
            "Section Returned Successfully.",
            200
        );
    }

    public function show(int $id)
    {
        $section_details = $this->sectionService->getSectionById($id);

        if (!$section_details) {
            return ResponseHelper::error($section_details, "Section not found!", 404);
        }

        return ResponseHelper::success(
            new SectionResource($section_details),
            "Section Returned Successfully.",
            200
        );
    }

    public function store(Request $request)
    {
        try{
            $section_details = $this->sectionService->addNewSection($request);

            return ResponseHelper::success(
                new SectionResource($section_details),
                "Section Returned Successfully.",
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }

    public function update(Request $request, int $id)
    {
        try {
            $section_details = $this->sectionService->updateSection($request->all(), $id);

            return ResponseHelper::success(
                new SectionResource($section_details),
                "Section Updated Successfully.",
                201
            );
        } catch (\Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }

    // DELETE /page/{id}
    public function destroy(int $id)
    {
        try {
            $this->sectionService->deleteSection($id);

            return ResponseHelper::success(null, "Section Deleted Successfully", 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }
}
