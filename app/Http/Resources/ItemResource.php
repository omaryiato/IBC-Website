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

            'media_id' => $this->media_id,

            'title' => $this->title,

            'description' => $this->description,

            'link' => $this->link,

            'extra_data' => $this->extra_data,

            'is_active' => $this->is_active,

            'sort_order' => $this->sort_order,

            'created_by' => $this->created_by,

            'updated_by' => $this->updated_by,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),

            'item_media' => new MediaResource($this->whenLoaded('media')),
        ];
    }
}
