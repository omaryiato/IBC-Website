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

        return $this->sectionRepository->addNewSection($this->prepareSectionDetails($section_request));
    }

    public function updateSection($request, int $id)
    {
        $section_request = $request->all();
        $section_details = $this->sectionRepository->getSectionById($id);

        if (!$section_details) {
            return null;
        }

        if ($request->hasFile('media')) {

            if (!empty($section_details->media_id)) {
                $this->mediaService->deleteMedia($section_details->media_id);
            }


            $media_id = $this->mediaService->prepareMedia($request->file('media'),'sections');

            $section_request['media_id'] = $media_id;

        }

        $section_request = $this->prepareSectionDetails($section_request);

        return $this->sectionRepository->updateSection($section_details, $section_request);
    }

    public function deleteSection(int $id)
    {
        $section_details = $this->sectionRepository->getSectionById($id);
        if (!$section_details) {
            return null;
        }
        return $this->sectionRepository->deleteSection($section_details);
    }

    public function prepareSectionDetails(array $section_request) : array
    {
        $data = [
            'page_id' => $section_request['page_id'],
            'type' => $section_request['type'],
            'title' => json_decode($section_request['title'], true) ?? null,
            'description' => json_decode($section_request['description'], true) ?? null,
            'settings' => json_decode($section_request['settings'], true) ?? null,
            'sort_order' => $section_request['sort_order'] ?? 0,
            'section_code' => $section_request['section_code'],
            'media_id' => $section_request['media_id'] ?? null,
        ];

        if (isset($section_request['created_by'])) {
            $data['created_by'] = $section_request['created_by'];
        }

        if (isset($section_request['updated_by'])) {
            $data['updated_by'] = $section_request['updated_by'];
        }

        return $data;
    }
}
