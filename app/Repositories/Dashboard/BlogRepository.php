<?php

namespace App\Repositories\Dashboard;

use App\Models\Blog;
use App\Repositories\Dashboard\BaseRepository;

class BlogRepository
{
    public function getBlogsList()
    {
        return Blog::with(['media', 'user'])->get();
    }

    public function getBlogById(int $id)
    {
        return Blog::with(['media', 'user'])->findOrFail($id);
    }

    public function addNewBlog(array $blog_request)
    {
        return Blog::create($blog_request);
    }

    public function updateBlog(Blog $blog, array $blog_request)
    {
        $blog->update($blog_request);
        return $blog;
    }

    public function deleteBlog(Blog $blog)
    {
        return $blog->delete();
    }
}
