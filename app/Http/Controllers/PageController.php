<?php

namespace App\Http\Controllers;

use App\Models\AboutCompany;
use App\Models\Grooming;
use App\Models\Contact;
use App\Models\Post;
use App\Enums\ContentType;

class PageController extends Controller
{
    public function index()
    {
        $aboutCompany = AboutCompany::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        $contact = Contact::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return view('Index', [
            'aboutCompany' => $aboutCompany,
            'contact' => $contact
        ]);
    }

    public function grooming()
    {
        $grooming = Grooming::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return view('grooming', [
            'grooming' => $grooming,
            'posts' => $grooming->posts ? $grooming->posts()->paginate(5) : []
        ]);
    }

    public function post(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }
}
