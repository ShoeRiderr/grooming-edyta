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
        $grooming = Grooming::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $grooming->load('posts.image', 'images');

        return GroomingResource::make($grooming);
    }

    public function update(GroomingRequest $request): Responsable
    {
        $grooming = Grooming::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]
        );

        return GroomingResource::make($grooming);
    }
}
