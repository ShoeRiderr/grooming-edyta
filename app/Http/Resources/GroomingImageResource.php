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
            'id' => $this->id,
            'dog_race' => $this->dog_race,
            'dog_name' => $this->dog_name,
            'created_at' => $this->created_at,
            'images'    => ImageResource::collection($this->whenLoaded('images'))
        ];
    }
}
