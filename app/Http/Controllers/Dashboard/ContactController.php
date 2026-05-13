<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $contactService
    ) {}

    public function store(Request $request)
    {
        try{
            $message_details = $this->contactService
            ->submitMessage($request->all());

            return ResponseHelper::success(
                // RequestResource::collection($pages_list),
                $message_details,
                "Message sent Successfully.",
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }
}
