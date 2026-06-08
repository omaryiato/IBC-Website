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

        $blog_details = $this->blogRepository->addNewBlog($this->prepareBlogDetails($blog_request));

        if ($request->hasFile('media')) {

            $media_details = $this->mediaService->prepareMedia($request->file('media'),'blogs');

            $blog_details->media()->create($media_details);

        }

        return $blog_details;
        // return $blog_details->load('media');

    }

    public function updateBlog($request, int $id)
    {
        $blog_details = $this->blogRepository->getBlogById($id);

        if (!$blog_details) {
            return null;
        }

        $this->blogRepository->updateBlog(
            $blog_details,
            $this->prepareBlogDetails($request->all())
        );

        if ($request->hasFile('media')) {

            $blog_details->media->each(function ($media) {
                $this->mediaService->deleteMedia($media);
            });

            $blog_details->media()->create(
                $this->mediaService->prepareMedia(
                    $request->file('media'),
                    'blogs'
                )
            );
        }

        return $blog_details->fresh();
        // return $blog_details->fresh()->load('media');
    }

    public function deleteBlog(int $id)
    {
        $blog_details = $this->blogRepository->getBlogById($id);

        if (!$blog_details) {
            return null;
        }

        return $this->blogRepository->deleteBlog($blog_details);
    }

    public function prepareBlogDetails(array $blog_request): array
    {
        $data = [

            'slug' => $blog_request['slug'],

            'title' => json_decode($blog_request['title'], true),

            'excerpt' => !empty($blog_request['excerpt'])
                ? json_decode($blog_request['excerpt'], true)
                : null,

            'content' => json_decode($blog_request['content'], true),

            'seo' => !empty($blog_request['seo'])
                ? json_decode($blog_request['seo'], true)
                : null,

            // 'media_id' => $blog_request['media_id'] ?? null,

            'is_published' => $blog_request['is_published'] ?? 1,

            'published_at' => $blog_request['published_at'] ?? now(),
        ];

        if (isset($blog_request['created_by'])) {
            $data['created_by'] = $blog_request['created_by'];
        }

        if (isset($blog_request['updated_by'])) {
            $data['updated_by'] = $blog_request['updated_by'];
        }

        return $data;
    }
}
