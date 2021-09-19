<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhysiotherapyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string,mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'description' => $this->description,

            'posts' => PostResource::collection($this->whenLoaded('posts')),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'metas' => MetaResource::collection($this->whenLoaded('metas')),
        ];
    }
}
