<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroomingImageResource extends JsonResource
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
            'dog_race' => $this->dog_race,
            'dog_name' => $this->dog_name,
            'image'    => ImageResource::collection($this->whenLoaded('images'))
        ];
    }
}
