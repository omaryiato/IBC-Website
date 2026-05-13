<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PageRepository;
use App\Services\Dashboard\BaseService;

class PageService extends BaseService
{
    public function __construct(
        protected PageRepository $pageRepository
    ) {}

    public function getAllPages()
    {
        return $this->pageRepository->all();
    }

    public function getPageById(int $id)
    {
        $page_details = $this->pageRepository->findOrFail($id);

        if (!$page_details) {
            return null;
        }

        return $page_details;
    }
    // public function getPageBySlug(string $slug)
    // {
    //     $page = $this->pageRepository->findBySlug($slug);

    //     if (!$page) {
    //         return null;
    //     }

    //     return $page;
    // }

    public function getActivePages()
    {
        return $this->pageRepository->activePages();
    }

    public function createPage(array $page_request)
    {
        return $this->pageRepository->create($page_request);
    }

    public function updatePage(int $id, array $page_request)
    {
        return $this->pageRepository->update($id, $page_request);
    }
    public function deletePage(int $id)
    {
        return $this->pageRepository->delete($id);
    }
}
