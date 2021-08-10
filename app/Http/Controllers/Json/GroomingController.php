<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroomerRequest;
use App\Http\Resources\GroomerResource;
use App\Models\Groomer;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;

class GroomingController extends Controller
{
    public function show(): Responsable
    {
        $groomer = Groomer::where('type', ContentType::CONSTANT)->first();

        $groomer->load('posts.image');

        return GroomerResource::make($groomer);
    }

    public function edit(): Responsable
    {
        $groomer = Groomer::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $groomer->load('posts.image');

        return GroomerResource::make($groomer);
    }

    public function update(GroomerRequest $request): Responsable
    {
        $groomer = Groomer::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]
        );

        return GroomerResource::make($groomer);
    }
}
