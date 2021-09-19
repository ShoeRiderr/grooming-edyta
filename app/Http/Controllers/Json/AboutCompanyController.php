<?php

namespace App\Http\Controllers\Json;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutCompanyRequest;
use App\Http\Resources\AboutCompanyResource;
use App\Models\AboutCompany;
use App\Models\Meta;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\ConnectionInterface as Connection;
use Illuminate\Support\Arr;

class AboutCompanyController extends Controller
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection    = $connection;
    }

    public function show(): Responsable
    {
        $aboutCompany = AboutCompany::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $aboutCompany->load('metas');

        return AboutCompanyResource::make($aboutCompany);
    }

    public function update(AboutCompanyRequest $request): Responsable
    {
        $aboutCompany = $this->connection->transaction(function () use ($request) {
            $aboutCompany = AboutCompany::updateOrCreate(
                ['type' => ContentType::CONSTANT],
                [
                    'title'   => $request->input('title'),
                    'content' => $request->input('content'),
                    'description' => $request->input('description'),
                ]
            );

            $aboutCompany->metas->each(function (Meta $meta) use ($request, $aboutCompany) {
                if (!in_array($meta->id, $request->input('metas.*.id'))) {
                    $aboutCompany->metas()->where('id', $meta->id)->delete();
                }
            });

            foreach($request->input('metas') as $meta) {
                $aboutCompany->metas()->updateOrCreate(
                    [
                        'id' => Arr::get($meta, 'id'),
                    ],
                    [
                        'name' => Arr::get($meta, 'name'),
                    ]
                );
            }

            return $aboutCompany;
        });

        return AboutCompanyResource::make($aboutCompany);
    }
}
