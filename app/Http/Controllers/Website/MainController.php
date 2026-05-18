<?php

namespace App\Http\Controllers\Website;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CareerResource;
use App\Http\Resources\PageResource;
use App\Services\Website\MainService;
use Exception;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(
        protected MainService $mainService
    ) {}

    public function ActivePages()
    {
        $active_pages_list = $this->mainService->getActivePagesList();

        return ResponseHelper::success(
            PageResource::collection($active_pages_list),
            [
                "en" => "Pages Returned Successfully.",
                "ar" => "تم ارجاع الصفحات بنجاح"
            ],
            200
        );
    }

    public function PublishedBlogs()
    {
        $published_blogs_list = $this->mainService->getPublishedBlogsList();

        return ResponseHelper::success(
            BlogResource::collection($published_blogs_list),
            "Blogs Returned Successfully.",
            200
        );
    }

    public function ActiveCareers()
    {
        $active_careers_list = $this->mainService->getActiveCareersList();

        return ResponseHelper::success(
            CareerResource::collection($active_careers_list),
            "Careers Returned Successfully.",
            200
        );
    }

    public function ApplyJobApplication(Request $request)
    {
        try{
            $this->mainService->ApplyJobApplication($request->all());

            return ResponseHelper::success(
                null,
                "Application Applied Successfully.",
                201
            );

        } catch(Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }
    public function ContactUs(Request $request)
    {
        try{
            $this->mainService->ContactUs($request->all());

            return ResponseHelper::success(
                null,
                "Your Message Sent Successfully.",
                201
            );

        } catch(Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }
}
