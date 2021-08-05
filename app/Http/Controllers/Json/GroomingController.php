<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroomingRequest;
use App\Http\Resources\GroomingResource;
use App\Models\Grooming;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class GroomingController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(Grooming::paginate(10), 200);
    }

    public function show(Grooming $grooming): Responsable
    {
        return GroomingResource::make($grooming);
    }

    public function store(GroomingRequest $request): Responsable
    {
        $grooming = Grooming::create([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return GroomingResource::make($grooming);
    }

    public function update(GroomingRequest $request, Grooming $grooming): Responsable
    {
        $grooming->update([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return GroomingResource::make($grooming);
    }

    public function destroy(Grooming $grooming): JsonResponse
    {
        $grooming->delete();

        return new JsonResponse('', 200);
    }
}
