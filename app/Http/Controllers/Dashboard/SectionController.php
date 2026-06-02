<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Section\AddNewSection;
use App\Http\Requests\Section\UpdateSection;
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
            [
                'en' => trans('validation.get_sections_list'),
                'ar' => trans('validation.get_sections_list'),
            ],
            200
        );
    }

    public function show(int $id)
    {
        $section_details = $this->sectionService->getSectionById($id);

        if (!$section_details) {
            return ResponseHelper::error(
                $section_details,
                [
                    'en' => trans('validation.section_not_found'),
                    'ar' => trans('validation.section_not_found'),
                ],
                404);
        }

        return ResponseHelper::success(
            new SectionResource($section_details),
            [
                'en' => trans('validation.get_section_details'),
                'ar' => trans('validation.get_section_details'),
            ],
            200
        );
    }

    public function store(AddNewSection $request)
    {
        try{
            $section_details = $this->sectionService->addNewSection($request);

            return ResponseHelper::success(
                new SectionResource($section_details),
                [
                    'en' => trans('validation.add_new_section'),
                    'ar' => trans('validation.add_new_section'),
                ],
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }

    }

    public function update(UpdateSection $request, int $id)
    {
        try {
            $section_details = $this->sectionService->updateSection($request, $id);

            if (!$section_details) {
                return ResponseHelper::error(
                    $section_details,
                    [
                        'en' => trans('validation.section_not_found'),
                        'ar' => trans('validation.section_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                new SectionResource($section_details),
                [
                    'en' => trans('validation.update_section'),
                    'ar' => trans('validation.update_section'),
                ],
                201
            );
        } catch (\Exception $exception) {
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }

    // DELETE /page/{id}
    public function destroy(int $id)
    {
        try {
            $section_details = $this->sectionService->deleteSection($id);

            if (!$section_details) {
                return ResponseHelper::error(
                    $section_details,
                    [
                        'en' => trans('validation.section_not_found'),
                        'ar' => trans('validation.section_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                null,
                [
                    'en' => trans('validation.delete_section'),
                    'ar' => trans('validation.delete_section'),
                ],
                200);
        } catch (\Exception $exception) {
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }
}
