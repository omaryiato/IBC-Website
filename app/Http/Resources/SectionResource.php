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

            'type' => $this->type,

            'title' => $this->title,

            'description' => $this->description,

            'settings' => $this->settings,

            'sort_order' => $this->sort_order,

            'section_media' => new MediaResource($this->whenLoaded('media')),

            'items' => ItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
