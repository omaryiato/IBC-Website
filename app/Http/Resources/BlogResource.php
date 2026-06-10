<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'slug' => $this->slug,

            'title' => $this->title,

            'excerpt' => $this->excerpt,

            'content' => $this->content,

            'seo' => $this->seo,

            // 'media_id' => $this->media_id,

            'is_published' => $this->is_published,

            // 'published_at' => $this->published_at,
            'published_at' => $this->published_at?->format('Y-m-d H:i:s'),

            'blog_media' => new MediaResource($this->whenLoaded('media')),
            // 'blog_media' => MediaResource::collection($this->whenLoaded('media')),

            'stream_url' => str_starts_with($this->media?->mime_type, 'video/')
            ? ltrim(parse_url(route('media.stream', $this->media?->id), PHP_URL_PATH), '/')
            : null,
        ];
    }
}
