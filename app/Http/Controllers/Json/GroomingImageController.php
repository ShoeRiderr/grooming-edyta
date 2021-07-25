<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GroomingImage\StoreRequest;
use App\Http\Resources\GroomingImageResource;
use App\Models\GroomingImage;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Database\ConnectionInterface as Connection;
use Illuminate\Support\Arr;

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
    public function store(StoreRequest $request): Responsable
    {
        $groomingImage = $this->connection->transaction(function () use ($request) {
            $groomingImage = GroomingImage::create([
                'dog_race' => $request->input('dog_race'),
                'dog_name' => $request->input('dog_name'),
            ]);

            foreach ($request->input('image') as $index => $attributes) {
                /** @var \Illuminate\Http\UploadedFile */
                $file     = $request->file("image.{$index}.file");
                $pathname = $file->store("image/{$groomingImage->id}");

                $images = $groomingImage->images()->make([
                    'file_pathname' => $pathname,
                    'name'          => Arr::get($attributes, 'name'),
                    'description'   => Arr::get($attributes, 'description')
                ]);

                $images->save();

            }

            return $groomingImage;
        });

        return GroomingImageResource::make($groomingImage);
    }
}
