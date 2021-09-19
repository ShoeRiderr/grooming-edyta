<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhysiotherapyRequest;
use App\Http\Resources\PhysiotherapyResource;
use App\Models\Physiotherapy;
use App\Models\Meta;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;
use Illuminate\Support\Arr;

class PhysiotherapyController extends Controller
{
    public function show(): Responsable
    {
        $physiotherapy = Physiotherapy::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $physiotherapy->load('posts.image', 'images', 'metas');

        return PhysiotherapyResource::make($physiotherapy);
    }

    public function update(PhysiotherapyRequest $request): Responsable
    {
        $physiotherapy = Physiotherapy::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
                'description'  => $request->input('description'),
            ]
        );

        $physiotherapy->metas->each(function (Meta $meta) use ($request, $physiotherapy) {
            if (!in_array($meta->id, $request->input('metas.*.id'))) {
                $physiotherapy->metas()->where('id', $meta->id)->delete();
            }
        });

        foreach($request->input('metas') as $meta) {
            $physiotherapy->metas()->updateOrCreate(
                [
                    'id' => Arr::get($meta, 'id'),
                ],
                [
                    'name' => Arr::get($meta, 'name'),
                ]
            );
        }

        return PhysiotherapyResource::make($physiotherapy);
    }
}
