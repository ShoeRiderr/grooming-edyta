<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\DogHotelRequest;
use App\Http\Resources\DogHotelResource;
use App\Models\DogHotel;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class DogHotelController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(DogHotel::paginate(10), 200);
    }

    public function show(DogHotel $dogHotel): Responsable
    {
        return DogHotelResource::make($dogHotel);
    }

    public function store(DogHotelRequest $request): Responsable
    {
        $dogHotel = DogHotel::create([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

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

    public function destroy(DogHotel $dogHotel): JsonResponse
    {
        $dogHotel->delete();

        return new JsonResponse('', 200);
    }
}
