<?php

namespace App\Repositories\Dashboard;

use App\Models\ContactMessage;
use App\Repositories\Dashboard\BaseRepository;

class ContactMessageRepository
{
    public function getContactMessagesList()
    {
        return ContactMessage::all();
    }

    public function getContactMessageById(int $id)
    {
        return ContactMessage::findOrFail($id);
    }
}
