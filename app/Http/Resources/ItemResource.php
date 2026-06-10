<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'section_id' => $this->section_id,

            // 'media_id' => $this->media_id,

            'type' => $this->type,

            'title' => $this->title,

            'description' => $this->description,

            'link' => $this->link,

            'extra_data' => $this->extra_data,

            'is_active' => $this->is_active,

            'sort_order' => $this->sort_order,

            'item_code' => $this->item_code,

            'created_by' => $this->created_by,

            'updated_by' => $this->updated_by,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),

            'item_media' => new MediaResource($this->whenLoaded('media')),
            // 'item_media' => MediaResource::collection($this->whenLoaded('media')),

            'stream_url' => str_starts_with($this->media?->mime_type, 'video/')
            ? ltrim(parse_url(route('media.stream', $this->media?->id), PHP_URL_PATH), '/')
            : null,
        ];
    }
}
