<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\DogHotelRequest;
use App\Http\Resources\DogHotelResource;
use App\Models\DogHotel;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;

class DogHotelController extends Controller
{
    public function show(): Responsable
    {
        $dogHotel = DogHotel::where('type', ContentType::CONSTANT)->get();

        $dogHotel->load('posts');

        return DogHotelResource::make($dogHotel);
    }

    public function edit(): Responsable
    {
        $dogHotel = DogHotel::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return DogHotelResource::make($dogHotel);
    }

    public function update(DogHotelRequest $request, DogHotel $dogHotel): Responsable
    {
        $dogHotel->update([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return DogHotelResource::make($dogHotel);
    }
}
