<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\DogHotelRequest;
use App\Http\Resources\DogHotelResource;
use App\Models\DogHotel;
use App\Models\Meta;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;
use Illuminate\Support\Arr;

class DogHotelController extends Controller
{
    public function show(): Responsable
    {
        $dogHotel = DogHotel::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $dogHotel->load('posts.image', 'images', 'metas');

        return DogHotelResource::make($dogHotel);
    }

    public function update(DogHotelRequest $request): Responsable
    {
        $dogHotel = DogHotel::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
                'description'  => $request->input('description'),
            ]
        );

        $dogHotel->metas->each(function (Meta $meta) use ($request, $dogHotel) {
            if (!in_array($meta->id, $request->input('metas.*.id'))) {
                $dogHotel->metas()->where('id', $meta->id)->delete();
            }
        });

        foreach($request->input('metas') as $meta) {
            $dogHotel->metas()->updateOrCreate(
                [
                    'id' => Arr::get($meta, 'id'),
                ],
                [
                    'name' => Arr::get($meta, 'name'),
                ]
            );
        }

        return DogHotelResource::make($dogHotel);
    }
}
