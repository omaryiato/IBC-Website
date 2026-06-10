<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'page_id' => $this->page_id,

            // 'media_id' => $this->media_id,

            'type' => $this->type,

            'title' => $this->title,

            'description' => $this->description,

            'settings' => $this->settings,

            'sort_order' => $this->sort_order,

            'section_code' => $this->section_code,

            'is_active' => $this->is_active,

            'created_by' => $this->created_by,

            'updated_by' => $this->updated_by,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),

            'section_media' => new MediaResource($this->whenLoaded('media')),
            // 'section_media' => MediaResource::collection($this->whenLoaded('media')),

            'items' => ItemResource::collection($this->whenLoaded('items')),

            'stream_url' => str_starts_with($this->media?->mime_type, 'video/')
                ? preg_replace('#(?<!:)//\+#', '/', route('media.stream', $this->media?->id))
                : null,
        ];
    }
}
