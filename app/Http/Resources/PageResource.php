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

            'title' => $this->title ?? null,

            'meta_title' => $this->meta_title,

            'description' => $this->description ?? null,

            'meta_description' => $this->meta_description,

            "is_active" => $this->is_active,

            "page_code" => $this->page_code,

            "sort_order" => $this->sort_order,

            'created_by' => $this->created_by,

            'updated_by' => $this->updated_by,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),

            'page_media' => new MediaResource($this->whenLoaded('media')),
            // 'page_media' => MediaResource::collection($this->whenLoaded('media')),

            'sections' => SectionResource::collection($this->whenLoaded('sections')),

            'stream_url' => str_starts_with($this->media?->mime_type, 'video/')
                ? preg_replace('#(?<!:)//+#', '/', route('media.stream', $this->media?->id))
                : null,
        ];
    }
}
