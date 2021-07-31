<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PhysiotherapyResource;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Physiotherapy;
use App\Http\Requests\PhysiotherapyRequest;

class PhysiotherapyController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(Physiotherapy::paginate(10), 200);
    }

    public function show(Physiotherapy $physiotherapy): Responsable
    {
        return PhysiotherapyResource::make($physiotherapy);
    }

    public function store(PhysiotherapyRequest $request): Responsable
    {
        $physiotherapy = Physiotherapy::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return PhysiotherapyResource::make($physiotherapy);
    }

    public function update(PhysiotherapyRequest $request, Physiotherapy $physiotherapy): Responsable
    {
        $physiotherapy->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return PhysiotherapyResource::make($physiotherapy);
    }

    public function destroy(Physiotherapy $physiotherapy): JsonResponse
    {
        $physiotherapy->delete();

        return new JsonResponse('', 200);
    }
}
