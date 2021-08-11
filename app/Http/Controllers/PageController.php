<?php

namespace App\Http\Controllers;

use App\Models\AboutCompany;
use App\Models\Contact;
use App\Enums\ContentType;

class PageController extends Controller
{
    public function index()
    {
        $aboutCompany = AboutCompany::where('type', ContentType::CONSTANT)->first();
        $contact = Contact::where('type', ContentType::CONSTANT)->first();

        return view('Index', [
            'aboutCompany' => $aboutCompany,
            'contact' => $contact
        ]);
    }
}
