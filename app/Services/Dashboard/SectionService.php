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
        return $this->sectionRepository->all();
    }

    public function getSectionById(int $id)
    {
        $section_details = $this->sectionRepository->findOrFail($id);

        if (!$section_details) {
            return null;
        }

        return $section_details;
    }


    public function createSection(array $section_request)
    {
        return $this->sectionRepository->create($section_request);
    }

    public function updateSection(int $id, array $section_request)
    {
        return $this->sectionRepository->update($id, $section_request);
    }
    public function deleteSection(int $id)
    {
        return $this->sectionRepository->delete($id);
    }
}
