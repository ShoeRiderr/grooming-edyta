<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroomingImage\StoreRequest;
use App\Http\Resources\GroomingImageResource;
use App\Models\GroomingImage;
use Illuminate\Contracts\Support\Responsable;

class GroomingImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(StoreRequest $request, GroomingImage $groomingImage): Responsable
    {
        $groomingImage = GroomingImage::create([
            'dog_race' => $request->input('dog_race'),
            'dog_name' => $request->input('dog_name'),
        ]);

        $documentScans = [];

        foreach ($request->input('document-scan') as $index => $attributes) {
            /** @var \Illuminate\Http\UploadedFile */
            $file     = $request->file("document-scan.{$index}.file");
            $pathname = $file->store("document-scan/{$groomingImage->id}");

            $images = $groomingImage->images()->make([
                'file_pathname' => $pathname,
                'name'          => Arr::get($attributes, 'name'),
                'description'   => Arr::get($attributes, 'description'),
                'type'          => Arr::get($attributes, 'type'),
            ]);

            $images->save();

            $documentScans[] = $images;
        }

        return GroomingImageResource::collection($documentScans);
    }
}
