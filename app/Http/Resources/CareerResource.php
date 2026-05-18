<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'title' => $this->title,

            'description' => $this->description,

            'requirements' => $this->requirements,

            'location' => $this->location,

            'employment_type' => $this->employment_type,

            'deadline' => $this->deadline?->format('Y-m-d'),

            'is_active' => $this->is_active,

            'created_by' => $this->created_by,

            'updated_by' => $this->updated_by,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),

            'career_application' => CareerApplicationResource::collection($this->whenLoaded('applications')),
        ];
    }
}
