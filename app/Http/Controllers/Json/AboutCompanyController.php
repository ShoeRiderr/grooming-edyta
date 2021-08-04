<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\AboutCompanyResource;
use Illuminate\Contracts\Support\Responsable;
use App\Models\AboutCompany;
use App\Http\Requests\AboutCompanyRequest;
use App\Enums\ContentType;

class AboutCompanyController extends Controller
{
    public function show(): Responsable
    {
        return AboutCompanyResource::make(AboutCompany::where('type', ContentType::CONSTANT)->get());
    }

    public function edit(): Responsable
    {
        $aboutCompany = AboutCompany::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title' => '',
                'content' => '',
                'type' => ContentType::CONSTANT,
            ]
        );

        return AboutCompanyResource::make($aboutCompany);
    }

    public function update(AboutCompanyRequest $request, AboutCompany $aboutCompany): Responsable
    {
        $aboutCompany->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return AboutCompanyResource::make($aboutCompany);
    }
}
