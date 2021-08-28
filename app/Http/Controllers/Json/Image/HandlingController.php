<?php

namespace App\Http\Controllers\Json\Image;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\ConnectionInterface as Connection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Handling;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class HandlingController extends Controller
{
    private ?Handling $handling;

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->handling = Handling::where('type', ContentType::CONSTANT)->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ImageRequest $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(ImageRequest $request): Responsable
    {
        $image = $this->connection->transaction(function () use ($request) {
            foreach ($request->input('image') as $index => $attributes) {
                /** @var \Illuminate\Http\UploadedFile */
                $file = $request->file("image.{$index}.file");
                $pathname = $file->store("public");

                $image = $this->handling->images()->make([
                    'title' => Arr::get($attributes, 'title'),
                    'file_pathname' => Str::replace('public/', '', $pathname),
                    'name'          => Arr::get($attributes, 'name'),
                    'description'   => Arr::get($attributes, 'description'),
                ]);

                $image->save();
            }

            return $image;
        });

        return ImageResource::make($image);
    }

    public function destroy(Image $image)
    {
        Storage::delete('public/' . $image->file_pathname);
        $this->handling->images()->where('id', $image->id)->delete();

        return ImageResource::make($image);
    }
}
