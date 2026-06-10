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

        $page_details = $this->pageRepository->addNewPage($this->preparePageDetails($page_request));

        if ($request->hasFile('media')) {

            $media_details = $this->mediaService->prepareMedia(
                $request->file('media'),
                'pages'
            );

            $page_details->media()->create($media_details);
        }

        return $page_details;
        // return $page_details->load('media');
    }

    public function updatePage($request, int $id)
    {

        $page_details = $this->pageRepository->getPageById($id);

        if (!$page_details) {
            return null;
        }

        $this->pageRepository->updatePage(
                            $page_details,
                            $this->preparePageDetails($request->all()));

        if ($request->hasFile('media')) {

            // $page_details->media->each(function ($media) {
            //     $this->mediaService->deleteMedia($media);
            // });

            $this->mediaService->deleteMedia($page_details->media);


            $page_details->media()->create(
                $this->mediaService->prepareMedia(
                    $request->file('media'),
                    'pages'
                )
            );

        }

        return $page_details->fresh();
        // return $blog_details->fresh()->load('media');

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
            'title' => json_decode($page_request['title'], true) ?? null,
            'meta_title' => json_decode($page_request['meta_title'], true) ?? null,
            'description' => json_decode($page_request['description'], true) ?? null,
            'meta_description' => json_decode($page_request['meta_description'], true) ?? null,
            'is_active' => $page_request['is_active'] ?? 1,
            'page_code' => $page_request['page_code'],
            // 'media_id' => $page_request['media_id'] ?? null,
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
