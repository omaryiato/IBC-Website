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

        $section_details = $this->sectionRepository->addNewSection($this->prepareSectionDetails($section_request));

        if ($request->hasFile('media')) {

            $media_details = $this->mediaService->prepareMedia($request->file('media'),'sections');

            $section_details->media()->create($media_details);

        }

        return $section_details;
        // return $blog_details->load('media');
    }

    public function updateSection($request, int $id)
    {
        $section_details = $this->sectionRepository->getSectionById($id);

        if (!$section_details) {
            return null;
        }

        $this->sectionRepository->updateSection($section_details,
                                        $this->prepareSectionDetails($request->all()));


        if ($request->hasFile('media')) {

            // $section_details->media->each(function ($media) {
            //     $this->mediaService->deleteMedia($media);
            // });

            $this->mediaService->deleteMedia($section_details->media);

            $section_details->media()->create(
                $this->mediaService->prepareMedia(
                    $request->file('media'),
                    'sections'
                )
            );
        }

        return $section_details->fresh();
        // return $section_details->fresh()->load('media');

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
            // 'media_id' => $section_request['media_id'] ?? null,
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
