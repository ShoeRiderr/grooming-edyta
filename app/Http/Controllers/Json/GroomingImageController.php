<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroomingImage\StoreRequest;
use App\Http\Resources\GroomingImageResource;
use App\Models\GroomingImage;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Database\ConnectionInterface as Connection;

class GroomingImageController extends Controller
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(Request $request): Responsable
    {
        dd($request->all());
        $groomingImages = $this->connection->transaction(function () use ($request) {
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

            return $documentScans;
        });

        return GroomingImageResource::collection($documentScans);
    }
}
