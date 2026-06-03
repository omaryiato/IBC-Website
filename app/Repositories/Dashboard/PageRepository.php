<?php

namespace App\Repositories\Dashboard;

use App\Models\Page;
use App\Repositories\Dashboard\BaseRepository;

class PageRepository
{
    public function getPagesList()
    {
        return Page::with([
                    'media',
                    'sections.media',
                    'sections.items.media'
                ])->get();
    }

    public function getPageById(int $id)
    {
        return Page::with([
                    'media',
                    'sections.media',
                    'sections.items.media'
                ])->findOrFail($id);
    }

    public function addNewPage(array $page_request)
    {
        return Page::create($page_request);
    }

    public function updatePage(Page $page, array $page_request)
    {
        $page->update($page_request);
        return $page;
    }

    public function deletePage(Page $page)
    {
        return $page->delete();
    }
}
