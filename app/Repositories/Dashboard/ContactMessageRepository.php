<?php

namespace App\Repositories\Dashboard;

use App\Models\ContactMessage;
use App\Repositories\Dashboard\BaseRepository;

class ContactRepository extends BaseRepository
{

    public function __construct(ContactMessage $model)
    {
        $this->model = $model;
    }

    public function unread()
    {
        return $this->model
            ->where('is_read', false)
            ->get();
    }
}
