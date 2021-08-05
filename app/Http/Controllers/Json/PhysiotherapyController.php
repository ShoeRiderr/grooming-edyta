<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhysiotherapyRequest;
use App\Http\Resources\PhysiotherapyResource;
use App\Models\Physiotherapy;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ContentType;

class PhysiotherapyController extends Controller
{
    public function show(): Responsable
    {
        $physiotherapy = Physiotherapy::where('type', ContentType::CONSTANT)->get();

        $physiotherapy->load('posts');

        return PhysiotherapyResource::make($physiotherapy);
    }

    public function edit(): Responsable
    {
        $physiotherapy = Physiotherapy::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return PhysiotherapyResource::make($physiotherapy);
    }

    public function update(PhysiotherapyRequest $request, Physiotherapy $physiotherapy): Responsable
    {
        $physiotherapy->update([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return PhysiotherapyResource::make($physiotherapy);
    }
}
