<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SectionRepository;
use App\Services\Dashboard\MediaService;

class SectionService extends BaseService
{
    public function __construct(
        protected SectionRepository $sectionRepository,
        protected MediaService $mediaService
    ) {}

    public function getSectionsList()
    {
        return $this->sectionRepository->getSectionsList();
    }

    public function getSectionById(int $id)
    {
        $section_details = $this->sectionRepository->getSectionById($id);

        if (!$section_details) {
            return null;
        }

        return $section_details;
    }


    public function addNewSection($request)
    {
        $section_request = $request->all();

        if ($request->hasFile('media')) {

            $media_id = $this->mediaService->prepareMedia(
                $request->file('media'),
                'sections'
            );

            $section_request['media_id'] = $media_id;
        }

        return $this->sectionRepository->addNewSection($section_request);
    }

    public function updateSection($request, int $id)
    {
        $section_request = $request->all();
        $section_details = $this->sectionRepository->getSectionById($id);

        if ($request->hasFile('media')) {

            if (!empty($section_details->media_id)) {
                $this->mediaService->deleteMedia($section_details->media_id);
            }


            $media_id = $this->mediaService->prepareMedia($request->file('media'),'sections');

            $section_request['media_id'] = $media_id;

        }

        return $this->sectionRepository->updateSection($section_details, $section_request);
    }

    public function deleteSection(int $id)
    {
        $section_details = $this->sectionRepository->getSectionById($id);
        return $this->sectionRepository->deleteSection($section_details);
    }
}
