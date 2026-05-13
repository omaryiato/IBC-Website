<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ContactRepository;

class ContactService extends BaseService
{
    public function __construct(
        protected ContactRepository $contactRepository
    ) {}

    public function submitMessage(array $message_request)
    {
        $message_request['is_read'] = 0;

        return $this->contactRepository->create($message_request);
    }

    public function getUnreadMessages()
    {
        return $this->contactRepository->unread();
    }
}
