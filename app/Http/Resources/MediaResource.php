<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'file_name' => $this->file_name,

            'original_name' => $this->original_name,

            'file_path' => asset($this->file_path),

            'file_type' => $this->file_type,

            'file_size' => $this->file_size,

            'mime_type' => $this->mime_type,

            'alt_text' => $this->alt_text,

            'created_by' => $this->uploaded_by,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

        ];
    }
}
