<?php

namespace App\Http\Controllers;

use App\Models\AboutCompany;
use App\Models\Grooming;
use App\Models\Contact;
use App\Models\Handling;
use App\Models\Post;
use App\Models\DogHotel;
use App\Models\Physiotherapy;
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

        return view('Index', [
            'aboutCompany' => $aboutCompany
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
            'images' => $grooming->images ? $grooming->images()->get() : []
        ]);
    }

    public function physiotherapy()
    {
        $physiotherapy = Physiotherapy::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return view('physiotherapy', [
            'physiotherapy' => $physiotherapy,
            'images' => $physiotherapy->images ? $physiotherapy->images()->get() : []
        ]);
    }

    public function handling()
    {
        $handling = Handling::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return view('handling', [
            'handling' => $handling,
            'images' => $handling->images ? $handling->images()->get() : []
        ]);
    }

    public function dogHotel()
    {
        $dogHotel = DogHotel::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return view('dog-hotel', [
            'dogHotel' => $dogHotel,
            'images' => $dogHotel->images ? $dogHotel->images()->get() : []
        ]);
    }

    public function contact()
    {
        $contact = Contact::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );

        return view('contact', [
            'contact' => $contact
        ]);
    }

    public function post(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }
}
