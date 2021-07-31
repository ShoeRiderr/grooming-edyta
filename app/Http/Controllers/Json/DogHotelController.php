<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\DogHotelResource;
use Illuminate\Contracts\Support\Responsable;
use App\Models\DogHotel;

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

    public function store(Request $request): Responsable
    {
        $dogHotel = DogHotel::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return DogHotelResource::make($dogHotel);
    }

    public function update(Request $request, DogHotel $dogHotel): Responsable
    {
        $dogHotel->update([
            'title' => $request->input('title'),
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
