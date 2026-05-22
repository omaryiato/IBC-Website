<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\BlogRepository;
use App\Services\Dashboard\MediaService;
use Illuminate\Support\Str;

class BlogService extends BaseService
{
    public function __construct(
        protected BlogRepository $blogRepository,
        protected MediaService $mediaService
    ) {}

    public function getBlogsList()
    {
        return $this->blogRepository->getBlogsList();
    }


    public function getBlogById(int $id)
    {
        $blog_details = $this->blogRepository->getBlogById($id);
        if (!$blog_details) {
            return null;
        }
        return $blog_details;
    }

    public function addNewBlog($request)
    {
        $blog_request = $request->all();
        if ($request->hasFile('media')) {

            $media_id = $this->mediaService->prepareMedia($request->file('media'),'blogs');

            $blog_request['media_id'] = $media_id;
        }
        return $this->blogRepository->addNewBlog($this->prepareBlogDetails($blog_request));
    }

    public function updateBlog($request, int $id)
    {
        $blog_request = $request->all();
        $blog_details = $this->blogRepository->getBlogById($id);

        if ($request->hasFile('media')) {

            if (!empty($blog_details->media_id)) {
                $this->mediaService->deleteMedia($blog_details->media_id);
            }

            $media_id = $this->mediaService->prepareMedia($request->file('media'),'sections');

            $blog_request['media_id'] = $media_id;

        }

        $blog_request = $this->prepareBlogDetails($blog_request);
        return $this->blogRepository->updateBlog($blog_details, $blog_request);
    }
    public function deleteBlog(int $id)
    {
        $blog_details = $this->blogRepository->getBlogById($id);
        return $this->blogRepository->deleteBlog($blog_details);
    }

    public function prepareBlogDetails(array $blog_request): array
    {
        return [

            'slug' => $blog_request['slug'],

            'title' => json_decode($blog_request['title'], true),

            'excerpt' => !empty($blog_request['excerpt'])
                ? json_decode($blog_request['excerpt'], true)
                : null,

            'content' => json_decode($blog_request['content'], true),

            'seo' => !empty($blog_request['seo'])
                ? json_decode($blog_request['seo'], true)
                : null,

            'media_id' => $blog_request['media_id'] ?? null,

            'is_published' => $blog_request['is_published'] ?? 1,

            'published_at' => $blog_request['published_at'] ?? now(),
        ];
    }
}
