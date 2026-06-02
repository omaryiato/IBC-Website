<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\AddNewBlog;
use App\Http\Requests\Blog\UpdateBlog;
use App\Http\Resources\BlogResource;
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
            [
                'en' => trans('validation.get_blogs_list'),
                'ar' => trans('validation.get_blogs_list'),
            ],
            200
        );

    }

    public function show(int $id)
    {
        $blog_details = $this->blogService->getBlogById($id);

        if (!$blog_details) {
            return ResponseHelper::error(
                $blog_details,
                [
                    'en' => trans('validation.blog_not_found'),
                    'ar' => trans('validation.blog_not_found'),
                ],
                404);
        }

        return ResponseHelper::success(
            new BlogResource($blog_details),
            [
                'en' => trans('validation.get_blog_details'),
                'ar' => trans('validation.get_blog_details'),
            ],
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

    public function store(AddNewBlog $request)
    {
        try{
            $blog_details = $this->blogService->addNewBlog($request);

            return ResponseHelper::success(
                new BlogResource($blog_details),
                [
                    'en' => trans('validation.add_new_blog'),
                    'ar' => trans('validation.add_new_blog'),
                ],
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }

    }

    public function update(UpdateBlog $request, int $id)
    {
        try {
            $blog_details = $this->blogService->updateBlog($request, $id);

            if (!$blog_details) {
                return ResponseHelper::error(
                    $blog_details,
                    [
                        'en' => trans('validation.blog_not_found'),
                        'ar' => trans('validation.blog_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                new BlogResource($blog_details),
                [
                    'en' => trans('validation.update_blog'),
                    'ar' => trans('validation.update_blog'),
                ],
                201
            );
        } catch (\Exception $exception) {
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }

    // DELETE /page/{id}
    public function destroy(int $id)
    {
        try {
            $blog_details = $this->blogService->deleteBlog($id);

            if (!$blog_details) {
                return ResponseHelper::error(
                    $blog_details,
                    [
                        'en' => trans('validation.blog_not_found'),
                        'ar' => trans('validation.blog_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                null,
                [
                    'en' => trans('validation.delete_blog'),
                    'ar' => trans('validation.delete_blog'),
                ],
                200);
        } catch (\Exception $exception) {
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }
}
