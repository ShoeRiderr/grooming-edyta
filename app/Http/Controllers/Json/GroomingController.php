<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\GroomingResource;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Grooming;

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

    public function store(Request $request): Responsable
    {
        $grooming = Grooming::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return GroomingResource::make($grooming);
    }

    public function update(Request $request, Grooming $grooming): Responsable
    {
        $grooming->update([
            'title' => $request->input('title'),
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
