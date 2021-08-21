<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HandlingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,

            'posts' => PostResource::collection($this->whenLoaded('posts'))
        ];
    }
}