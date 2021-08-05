<?php

namespace App\Http\Controllers\Json;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutCompanyRequest;
use App\Http\Resources\AboutCompanyResource;
use App\Models\AboutCompany;
use Illuminate\Contracts\Support\Responsable;

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
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return AboutCompanyResource::make($aboutCompany);
    }

    public function update(AboutCompanyRequest $request, AboutCompany $aboutCompany): Responsable
    {
        $aboutCompany->update([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return AboutCompanyResource::make($aboutCompany);
    }
}
