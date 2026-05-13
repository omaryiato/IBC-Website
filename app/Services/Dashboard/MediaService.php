<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\MediaRepository;

class MediaService extends BaseService
{
    public function __construct(
        protected MediaRepository $mediaRepository
    ) {}

    public function upload(array $media_request)
    {
        return $this->mediaRepository->create($media_request);
    }

    public function getUserMedia(int $user_id)
    {
        return $this->mediaRepository->uploadByUser($user_id);
    }
}
