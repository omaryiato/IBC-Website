<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\BlogRepository;
use Illuminate\Support\Str;

class BlogService extends BaseService
{
    public function __construct(
        protected BlogRepository $blogRepository
    ) {}

    public function getBlogsList()
    {
        return $this->blogRepository->all();
    }


    public function getBlogById(int $id)
    {
        $blog_details = $this->blogRepository->findOrFail($id);
        if (!$blog_details) {
            return null;
        }
        return $blog_details;
    }

    public function createBlog(array $blog_request)
    {
        return $this->blogRepository->create($blog_request);
    }

    public function updateBlog(int $id, array $blog_request)
    {
        return $this->blogRepository->update($id, $blog_request);
    }
    public function deleteBlog(int $id)
    {
        return $this->blogRepository->delete($id);
    }
}
