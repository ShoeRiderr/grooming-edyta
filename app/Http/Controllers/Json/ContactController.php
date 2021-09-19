<?php

namespace App\Http\Controllers\Json;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\Meta;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Arr;

class ContactController extends Controller
{
    public function show(): Responsable
    {
        $contact = Contact::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $contact->load('metas');

        return ContactResource::make($contact);
    }

    public function update(ContactRequest $request): Responsable
    {
        $contact = Contact::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
                'description'  => $request->input('description'),
            ]
        );

        $contact->metas->each(function (Meta $meta) use ($request, $contact) {
            if (!in_array($meta->id, $request->input('metas.*.id'))) {
                $contact->metas()->where('id', $meta->id)->delete();
            }
        });

        foreach($request->input('metas') as $meta) {
            $contact->metas()->updateOrCreate(
                [
                    'id' => Arr::get($meta, 'id'),
                ],
                [
                    'name' => Arr::get($meta, 'name'),
                ]
            );
        }

        return ContactResource::make($contact);
    }
}
