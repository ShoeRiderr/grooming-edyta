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
use App\Models\DogHotel;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class DogHotelController extends Controller
{
    private ?DogHotel $dogHotel;

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->dogHotel = DogHotel::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );
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
                $file->move(public_path().'/storage/', $img = 'img_'.$index.time().'.'.$file->getClientOriginalExtension());

                $image = $this->dogHotel->images()->make([
                    'title' => Arr::get($attributes, 'title'),
                    'file_pathname' => $img,
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
        File::delete(public_path().'/storage/' . $image->file_pathname);

        $image->delete();

        return ImageResource::make($image);
    }
}
