<?php

namespace App\Repositories\Dashboard;

use App\Models\Section;
use App\Repositories\Dashboard\BaseRepository;

class SectionRepository
{

    public function getSectionsList()
    {
        return Section::with(['page','items','media'])->get();
    }

    public function getSectionDetails(int $id)
    {
        return Section::with(['page','items','media'])->findOrFail($id);
    }

    public function addNewSection(array $section_request)
    {
        return Section::create($section_request);
    }

    public function updateSection(Section $section, array $section_request)
    {
        $section->update($section_request);
        return $section;
    }

    public function deleteSection(Section $section)
    {
        return $section->delete();
    }
}
