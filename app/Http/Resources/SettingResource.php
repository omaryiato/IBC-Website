<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'key' => $this->key,

            'value' => $this->value,

            'created_by' => $this->created_by,

            'updated_by' => $this->updated_by,

            // 'created_at' => $this->created_at,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            // 'updated_at' => $this->updated_at,
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            // 'deleted_at' => $this->deleted_at,
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),
        ];
    }
}
