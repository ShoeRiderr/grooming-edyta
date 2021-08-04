<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ContactResource;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Enums\ContentType;

class ContactController extends Controller
{
    public function show(): Responsable
    {
        return ContactResource::make(Contact::where('type', ContentType::CONSTANT)->get());
    }

    public function edit(): Responsable
    {
        $contact = Contact::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title' => '',
                'content' => '',
                'type' => ContentType::CONSTANT,
            ]
        );

        return ContactResource::make($contact);
    }

    public function update(ContactRequest $request, Contact $contact): Responsable
    {
        $contact->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return ContactResource::make($contact);
    }
}
