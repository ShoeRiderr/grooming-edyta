<?php

namespace App\Http\Controllers\Json;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Contracts\Support\Responsable;

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

        return ContactResource::make($contact);
    }

    public function update(ContactRequest $request): Responsable
    {
        Contact::updateOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]
        );

        return ContactResource::make($contact);
    }
}
