<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PageRepository;
use App\Services\Dashboard\BaseService;

class PageService extends BaseService
{
    public function __construct(
        protected PageRepository $pageRepository
    ) {}

    public function getPagesList()
    {
        return $this->pageRepository->getPagesList();
    }

    public function getPageById(int $id)
    {
        $page_details = $this->pageRepository->getPageById($id);

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

    // public function getActivePages()
    // {
    //     return $this->pageRepository->activePages();
    // }

    public function addNewPage(array $page_request)
    {
        return $this->pageRepository->addNewPage($this->preparePageDetails($page_request));
    }

    public function updatePage(array $page_request, int $id)
    {
        $page_details = $this->pageRepository->getPageById($id);
        return $this->pageRepository->updatePage($page_details, $page_request);
    }
    public function deletePage(int $id)
    {
        $page_details = $this->pageRepository->getPageById($id);
        return $this->pageRepository->deletePage($page_details);
    }

    public function preparePageDetails(array $page_request){
        return  [
            // 'slug' => $page_request->slug,
            // 'title' => json_decode($page_request->title, true),
            // 'excerpt' => json_decode($page_request->excerpt, true),
            // 'content' => json_decode($page_request->content, true),
            // 'seo' => json_decode($page_request->seo, true),
        ];
    }
}
