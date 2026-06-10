<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\MediaResource;
use App\Services\Dashboard\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function __construct(
        protected MediaService $mediaService
    ) {}

    // public function store(Request $request)
    // {
    //     try{
    //         // upload logic later

    //         $media_details = $this->mediaService->upload([
    //             'file_name' => 'example.webp',
    //             'file_path' => 'uploads/example.webp',
    //         ]);

    //         return ResponseHelper::success(
    //             MediaResource::collection($media_details),
    //             "Media sent Successfully.",
    //             201
    //         );

    //     } catch(\Exception $exception){
    //         return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
    //     }

    // }

    public function stream(int $id)
    {
        $media_details = $this->mediaService->stream($id);

        if(!$media_details){
            return ResponseHelper::error(
                    $media_details,
                    [
                        'en' => trans('validation.media_not_found'),
                        'ar' => trans('validation.media_not_found'),
                    ],
                    404);
        }

        return $media_details;
    }
}
