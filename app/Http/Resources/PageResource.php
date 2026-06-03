<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'slug' => $this->slug,

            'meta_title' => $this->meta_title,

            'meta_description' => $this->meta_description,

            "is_active" => $this->is_active,

            "page_code" => $this->page_code,

            'created_by' => $this->created_by,

            'updated_by' => $this->updated_by,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),

            'page_media' => new MediaResource($this->whenLoaded('media')),

            'sections' => SectionResource::collection($this->whenLoaded('sections')),
        ];
    }
}
