<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Services\Dashboard\PageService;
use Exception;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        protected PageService $pageService
    ) {}

    public function index()
    {
        $pages_list = $this->pageService->getPagesList();

        return ResponseHelper::success(
            PageResource::collection($pages_list),
            [
                "en" => "Pages Returned Successfully.",
                "ar" => "تم ارجاع الصفحات بنجاح"
            ],
            200
        );
    }

    public function show(int $id)
    {
        $page_details = $this->pageService->getPageById($id);

        if (!$page_details) {
            return ResponseHelper::error($page_details, "Page not found!", 404);
        }

        return ResponseHelper::success(
            new PageResource($page_details),
            "Page Returned Successfully.",
            200
        );
    }
    // public function show(string $slug)
    // {
    //     $page_details = $this->pageService->getPageBySlug($slug);

    //     if (!$page_details) {
    //         return ResponseHelper::error($page_details, "Page not found!", 404);
    //     }

    //     return ResponseHelper::success(
    //         new PageResource($page_details),
    //         "Page Returned Successfully.",
    //         200
    //     );
    // }

    public function store(Request $request)
    {
        try{
            $page_details = $this->pageService->addNewPage($request->all());

            return ResponseHelper::success(
                new PageResource($page_details),
                "Page created successfully.",
                201
            );

        } catch(Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }

    public function update(Request $request, int $id)
    {
        try {
            $page_details = $this->pageService->updatePage($request->all(), $id);

            return ResponseHelper::success(
                new PageResource($page_details),
                "Page Updated Successfully.",
                201
            );
        } catch (Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }

    // DELETE /page/{id}
    public function destroy(int $id)
    {
        try {
            $this->pageService->deletePage($id);

            return ResponseHelper::success(null, "Page Deleted Successfully", 200);
        } catch (Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }
}
