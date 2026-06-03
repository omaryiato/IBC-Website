<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PageRepository;
use App\Services\Dashboard\BaseService;
use App\Services\Dashboard\MediaService;


class PageService extends BaseService
{
    public function __construct(
        protected PageRepository $pageRepository,
        protected MediaService $mediaService
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

    public function addNewPage($request)
    {
        $page_request = $request->all();

        if ($request->hasFile('media')) {

            $media_id = $this->mediaService->prepareMedia(
                $request->file('media'),
                'pages'
            );

            $page_request['media_id'] = $media_id;
        }

        return $this->pageRepository->addNewPage($this->preparePageDetails($page_request));
    }

    public function updatePage($request, int $id)
    {
        $page_request = $request->all();

        $page_details = $this->pageRepository->getPageById($id);

        if (!$page_details) {
            return null;
        }

        if ($request->hasFile('media')) {

            if (!empty($page_details->media_id)) {
                $this->mediaService->deleteMedia($page_details->media_id);
            }


            $media_id = $this->mediaService->prepareMedia($request->file('media'),'pages');

            $page_request['media_id'] = $media_id;

        }

        $page_request = $this->preparePageDetails($page_request);
        return $this->pageRepository->updatePage($page_details, $page_request);
        
    }
    public function deletePage(int $id)
    {
        $page_details = $this->pageRepository->getPageById($id);
        if (!$page_details) {
            return null;
        }
        return $this->pageRepository->deletePage($page_details);
    }

    public function preparePageDetails(array $page_request) : array
    {
        $data =  [
            'slug' => $page_request['slug'],
            'meta_title' => json_decode($page_request['meta_title'], true) ?? null,
            'meta_description' => json_decode($page_request['meta_description'], true) ?? null,
            'is_active' => $page_request['is_active'] ?? 1,
            'page_code' => $page_request['page_code'],
            'media_id' => $page_request['media_id'] ?? null,
        ];

        if (isset($page_request['created_by'])) {
            $data['created_by'] = $page_request['created_by'];
        }

        if (isset($page_request['updated_by'])) {
            $data['updated_by'] = $page_request['updated_by'];
        }

        return $data;
    }
}
