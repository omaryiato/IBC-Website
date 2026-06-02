<?php

namespace App\Http\Controllers\Website;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CareerApplication\AddNewCareerApplication;
use App\Http\Requests\ContactMessage\AddNewContactMessage;
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
                'en' => trans('validation.home_page'),
                'ar' => trans('validation.home_page'),
            ],
            200
        );
    }

    public function PublishedBlogs()
    {
        $published_blogs_list = $this->mainService->getPublishedBlogsList();

        return ResponseHelper::success(
            BlogResource::collection($published_blogs_list),
            [
                'en' => trans('validation.blog_page'),
                'ar' => trans('validation.blog_page'),
            ],
            200
        );
    }

    public function ActiveCareers()
    {
        $active_careers_list = $this->mainService->getActiveCareersList();

        return ResponseHelper::success(
            CareerResource::collection($active_careers_list),
            [
                'en' => trans('validation.career_page'),
                'ar' => trans('validation.career_page'),
            ],
            200
        );
    }

    public function ApplyJobApplication(AddNewCareerApplication $request)
    {
        try{
            $this->mainService->ApplyJobApplication($request->all());

            return ResponseHelper::success(
                null,
                [
                    'en' => trans('validation.apply_job'),
                    'ar' => trans('validation.apply_job'),
                ],
                201
            );

        } catch(Exception $exception){
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }

    }
    public function ContactUs(AddNewContactMessage $request)
    {
        try{
            $this->mainService->ContactUs($request->all());

            return ResponseHelper::success(
                null,
                [
                    'en' => trans('validation.contact_us'),
                    'ar' => trans('validation.contact_us'),
                ],
                201
            );

        } catch(Exception $exception){
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
