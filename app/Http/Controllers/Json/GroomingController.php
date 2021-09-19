<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroomingRequest;
use App\Http\Resources\GroomingResource;
use App\Models\Grooming;
use App\Models\Meta;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;
use Illuminate\Support\Arr;

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

        $grooming->load('posts.image', 'images', 'metas');

        return GroomingResource::make($grooming);
    }

    public function update(GroomingRequest $request): Responsable
    {
        $grooming = Grooming::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
                'description'  => $request->input('description'),
            ]
        );

        $grooming->metas->each(function (Meta $meta) use ($request, $grooming) {
            if (!in_array($meta->id, $request->input('metas.*.id'))) {
                $grooming->metas()->where('id', $meta->id)->delete();
            }
        });

        foreach($request->input('metas') as $meta) {
            $grooming->metas()->updateOrCreate(
                [
                    'id' => Arr::get($meta, 'id'),
                ],
                [
                    'name' => Arr::get($meta, 'name'),
                ]
            );
        }

        return GroomingResource::make($grooming);
    }
}
