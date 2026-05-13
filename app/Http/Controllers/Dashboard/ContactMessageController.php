<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactMessageResource;
use App\Services\Dashboard\ContactMessageService;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function __construct(
        protected ContactMessageService $contactMessageService
    ) {}

    public function index()
    {
        $contact_messages_list = $this->contactMessageService->getContactMessagesList();

        return ResponseHelper::success(
            ContactMessageResource::collection($contact_messages_list),
            [
                "en" => "ContactMessages Returned Successfully.",
                "ar" => "تم ارجاع الصفحات بنجاح"
            ],
            200
        );
    }

    public function show(int $id)
    {
        $contact_message_details = $this->contactMessageService->getContactMessageById($id);

        if (!$contact_message_details) {
            return ResponseHelper::error($contact_message_details, "ContactMessage not found!", 404);
        }

        return ResponseHelper::success(
            new ContactMessageResource($contact_message_details),
            "ContactMessage Returned Successfully.",
            200
        );
    }
}
