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
        return $this->blogRepository->addNewBlog($blog_request);
    }

    public function updateBlog(array $blog_request, int $id)
    {
        $blog_details = $this->blogRepository->getBlogById($id);
        return $this->blogRepository->updateBlog($blog_details, $blog_request);
    }
    public function deleteBlog(int $id)
    {
        $blog_details = $this->blogRepository->getBlogById($id);
        return $this->blogRepository->deleteBlog($blog_details);
    }
}
