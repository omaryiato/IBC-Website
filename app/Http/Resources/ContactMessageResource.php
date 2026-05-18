<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactMessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'full_name' => $this->full_name,

            'email' => $this->email,

            'message' => $this->message,

            'is_read' => $this->is_read,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

        ];
    }
}
