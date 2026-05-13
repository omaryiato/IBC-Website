<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\BlogResource;
use App\Services\Dashboard\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        protected BlogService $blogService
    ) {}

    public function index()
    {
        $blogs_list = $this->blogService->getBlogsList();

        return ResponseHelper::success(
            BlogResource::collection($blogs_list),
            "Blogs Returned Successfully.",
            200
        );

    }

    public function show(int $id)
    {
        $blog_details = $this->blogService
            ->getBlogById($id);

        if (!$blog_details) {
            return ResponseHelper::error($blog_details, "Blog not found!", 404);
        }

        return ResponseHelper::success(
            new BlogResource($blog_details),
            "Blogs Returned Successfully.",
            200
        );
    }
    // public function show(string $slug)
    // {
    //     $blog_details = $this->blogService
    //         ->getBlogBySlug($slug);

    //     if (!$blog_details) {
    //         return ResponseHelper::error($blog_details, "Blog not found!", 404);
    //     }

    //     return ResponseHelper::success(
    //         new BlogResource($blog_details),
    //         "Blogs Returned Successfully.",
    //         200
    //     );
    // }

    public function store(Request $request)
    {
        try{
            $blog_details = $this->blogService
            ->createBlog($request->all());

            return ResponseHelper::success(
                new BlogResource($blog_details),
                "Blogs Created Successfully.",
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }

    public function update(Request $request, int $id)
    {
        try {
            $blog_details = $this->blogService->updateBlog($id, $request->all());

            return ResponseHelper::success(
                new BlogResource($blog_details),
                "Blog Updated Successfully.",
                201
            );
        } catch (\Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }

    // DELETE /page/{id}
    public function destroy(int $id)
    {
        try {
            $this->blogService->deleteBlog($id);

            return ResponseHelper::success(null, "Blog Deleted Successfully", 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }
}
