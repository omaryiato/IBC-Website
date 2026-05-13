<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SectionRepository;

class SectionService extends BaseService
{
    public function __construct(
        protected SectionRepository $sectionRepository
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


    public function addNewSection(array $section_request)
    {
        return $this->sectionRepository->addNewSection($section_request);
    }

    public function updateSection(array $section_request, int $id)
    {
        $section_details = $this->sectionRepository->getSectionById($id);
        return $this->sectionRepository->updateSection($section_details, $section_request);
    }
    public function deleteSection(int $id)
    {
        $section_details = $this->sectionRepository->getSectionById($id);
        return $this->sectionRepository->deleteSection($section_details);
    }
}
