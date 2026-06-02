<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\MediaRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MediaService
{
    public function __construct(
        protected MediaRepository $mediaRepository
    ) {}

    public function prepareMedia(UploadedFile $file, string $folder = 'website_media'): int
    {
        $media_name = $this->generateMediaName($file);

        $original_name = $file->getClientOriginalName();
        $mime_type     = $file->getMimeType();
        $file_size     = $file->getSize();
        $file_type     = $this->detectFileType($file);

        $media_path = $this->uploadMediaFile($file, $media_name, $folder);



        $media_details = $this->mediaRepository->addNewMedia([
            'file_name'     => $media_name,
            'original_name' => $original_name,
            'file_path'     => $media_path,
            'file_type'     => $file_type,
            'mime_type'     => $mime_type,
            'file_size'     => $file_size,
        ]);

        return $media_details['id'];
    }

    protected function generateMediaName(UploadedFile $file): string
    {
        $original_name = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        $original_name = str_replace(' ', '_', $original_name);

        $date = now()->format('d-M-Y');

        $extension = $file->getClientOriginalExtension();

        return "{$original_name}_{$date}.{$extension}";
    }

    protected function uploadMediaFile(UploadedFile $file,string $media_name,string $folder): string
    {
        $destination_path = public_path("documents\website_media\{$folder}");

        if (!File::exists($destination_path)) {
            File::makeDirectory($destination_path, 0755, true);
        }

        $file->move($destination_path, $media_name);

        return "documents\website_media\{$folder}\{$media_name}";
    }

    protected function detectFileType(UploadedFile $file): string
    {
        $mime = $file->getMimeType();

        if (str_contains($mime, 'image')) {
            return 'image';
        }

        if (str_contains($mime, 'video')) {
            return 'video';
        }

        if (str_contains($mime, 'pdf')) {
            return 'document';
        }

        return 'file';
    }

    public function deleteMedia(int $media_id)
    {
        $media = $this->mediaRepository->findById($media_id);

        if ($media && File::exists(public_path($media['file_path']))) {
            File::delete(public_path($media['file_path']));
        }

        return $this->mediaRepository->delete($media);
    }
}
