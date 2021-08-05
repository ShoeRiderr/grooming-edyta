<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroomingRequest;
use App\Http\Resources\GroomingResource;
use App\Models\Grooming;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;

class GroomingController extends Controller
{
    public function show(): Responsable
    {
        $grooming = Grooming::where('type', ContentType::CONSTANT)->get();

        $grooming->load('posts');

        return GroomingResource::make($grooming);
    }

    public function edit(): Responsable
    {
        $grooming = Grooming::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

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
}
