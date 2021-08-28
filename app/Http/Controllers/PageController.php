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

    public function dogHotel()
    {
        return view('dog-hotel', [
            'dogHotel' => $this->dogHotelModel(),
            'images' => $this->dogHotelModel()->images ? $this->dogHotelModel()->images()->get() : []
        ]);
    }

    public function grooming()
    {
        return view('grooming', [
            'grooming' => $this->groomingModel(),
            'images' => $this->groomingModel()->images ? $this->groomingModel()->images()->get() : []
        ]);
    }

    public function handling()
    {
        return view('handling', [
            'handling' => $this->handlingModel(),
            'images' => $this->handlingModel()->images ? $this->handlingModel()->images()->get() : []
        ]);
    }

    public function physiotherapy()
    {
        return view('physiotherapy', [
            'physiotherapy' => $this->physiotherapyModel(),
            'images' => $this->physiotherapyModel()->images ? $this->physiotherapyModel()->images()->get() : []
        ]);
    }

    public function news()
    {
        // dd($this->physiotherapyModel()->posts()->get());
        return view('news', [
            'dogHotel' => $this->dogHotelModel()->posts ,
            'grooming' => $this->groomingModel()->posts ,
            'handling' => $this->handlingModel()->posts ,
            'physiotherapy' => $this->physiotherapyModel()->posts ,
        ]);
    }

    public function post(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }

    private function dogHotelModel()
    {
        return DogHotel::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );
    }

    private function groomingModel()
    {
        return Grooming::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );
    }

    private function handlingModel()
    {
        return Handling::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );
    }

    private function physiotherapyModel()
    {
        return Physiotherapy::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );
    }
}
