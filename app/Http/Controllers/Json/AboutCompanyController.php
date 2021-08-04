<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\AboutCompanyResource;
use Illuminate\Contracts\Support\Responsable;
use App\Models\AboutCompany;
use App\Http\Requests\AboutCompanyRequest;

class AboutCompanyController extends Controller
{
    const TYPE = 1;

    public function show(): Responsable
    {
        return AboutCompanyResource::make(AboutCompany::last());
    }

    public function edit(): Responsable
    {
        $aboutCompany = AboutCompany::firstOrCreate(
            ['type' => self::TYPE],
            [
                'title' => '',
                'content' => '',
                'type' => self::TYPE,
            ]
        );

        return AboutCompanyResource::make($aboutCompany);
    }

    public function update(AboutCompanyRequest $request, AboutCompany $aboutCompany): Responsable
    {
        $aboutCompany = AboutCompany::firstOrCreate(
            ['type' => self::TYPE],
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'type' => self::TYPE,
            ]
        );

        return AboutCompanyResource::make($aboutCompany);
    }
}
