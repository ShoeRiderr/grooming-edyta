<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id'       => $this->id,
            'title'    => $this->title,
            'end_date' => $this->end_date,
            'content'  => $this->content,
            'description' => $this->description,

            'image' => ImageResource::make($this->whenLoaded('image')),
            'metas' => MetaResource::collection($this->whenLoaded('metas')),
        ];
    }
}
