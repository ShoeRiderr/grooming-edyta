<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id'      => $this->id,
            'title'   => $this->title,
            'date'    => $this->date->format('d.m.Y'),
            'time'    => $this->date->format('H:i'),
            'content' => $this->content,

            'image' => ImageResource::make($this->whenLoaded('image')),
        ];
    }
}
