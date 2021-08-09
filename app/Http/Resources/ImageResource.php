<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'file_pathname' => $this->file_pathname,
            'name' => $this->name,
            'extension' => $this->extension,
            'source' => $this->source,
            'description' => $this->description,
        ];
    }
}
