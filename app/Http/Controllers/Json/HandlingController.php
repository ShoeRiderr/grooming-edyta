<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\HandlingRequest;
use App\Http\Resources\HandlingResource;
use App\Models\Handling;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;

class HandlingController extends Controller
{
    public function show(): Responsable
    {
        $handling = Handling::where('type', ContentType::CONSTANT)->first();

        $handling->load('posts.image');

        return HandlingResource::make($handling);
    }

    public function edit(): Responsable
    {
        $handling = Handling::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $handling->load('posts.image');

        return HandlingResource::make($handling);
    }

    public function update(HandlingRequest $request): Responsable
    {
        $handling = Handling::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]
        );

        return HandlingResource::make($handling);
    }
}
