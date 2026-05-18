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

            'file_path' => asset($this->file_path),

            'file_type' => $this->file_type,

            'mime_type' => $this->mime_type,

            'alt_text' => $this->alt_text,
        ];
    }
}
