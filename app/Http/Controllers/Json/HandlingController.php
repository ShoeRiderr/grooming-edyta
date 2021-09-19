<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\HandlingRequest;
use App\Http\Resources\HandlingResource;
use App\Models\Handling;
use App\Models\Meta;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;
use Illuminate\Support\Arr;

class HandlingController extends Controller
{
    public function show(): Responsable
    {
        $handling = Handling::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $handling->load('posts.image', 'images', 'metas');

        return HandlingResource::make($handling);
    }

    public function update(HandlingRequest $request): Responsable
    {
        $handling = Handling::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
                'description'  => $request->input('description'),
            ]
        );

        $handling->metas->each(function (Meta $meta) use ($request, $handling) {
            if (!in_array($meta->id, $request->input('metas.*.id'))) {
                $handling->metas()->where('id', $meta->id)->delete();
            }
        });

        foreach($request->input('metas') as $meta) {
            $handling->metas()->updateOrCreate(
                [
                    'id' => Arr::get($meta, 'id'),
                ],
                [
                    'name' => Arr::get($meta, 'name'),
                ]
            );
        }

        return HandlingResource::make($handling);
    }
}
