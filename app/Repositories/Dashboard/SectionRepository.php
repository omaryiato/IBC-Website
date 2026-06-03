<?php

namespace App\Repositories\Dashboard;

use App\Models\Section;
use App\Repositories\Dashboard\BaseRepository;

class SectionRepository
{

    public function getSectionsList()
    {
        return Section::with(['page','items.media','media'])->get();
    }

    public function getSectionById(int $id)
    {
        return Section::with(['page','items.media','media'])->findOrFail($id);
    }


    public function addNewSection(array $section_request)
    {
        $last_order = Section::max('sort_order');

        $section_request['sort_order'] = $last_order + 1 ?? 0;

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
