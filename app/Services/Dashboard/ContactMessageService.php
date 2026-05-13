<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ContactMessageRepository;

class ContactMessageService extends BaseService
{
    public function __construct(
        protected ContactMessageRepository $contactMessageRepository
    ) {}

    public function getContactMessagesList()
    {
        return $this->contactMessageRepository->getContactMessagesList();
    }

    public function getContactMessageById(int $id)
    {
        $contact_message_details = $this->contactMessageRepository->getContactMessageById($id);

        if (!$contact_message_details) {
            return null;
        }

        return $contact_message_details;
    }

}
