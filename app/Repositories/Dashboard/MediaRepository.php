<?php

namespace App\Repositories\Dashboard;


use App\Models\Media;
use App\Repositories\Dashboard\BaseRepository;

class MediaRepository extends BaseRepository
{
    public function __construct(Media $media)
    {
        $this->model = $media;
    }

    public function uploadByUser(int $user_id)
    {
        return $this->model
            ->where('uploaded_by', $user_id)
            ->get();
    }
}
