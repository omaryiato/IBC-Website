<?php

namespace App\Repositories\Dashboard;


use App\Models\Media;
use App\Repositories\Dashboard\BaseRepository;

class MediaRepository
{
    public function addNewMedia(array $media_request)
    {
        return Media::create($media_request);
    }
}
