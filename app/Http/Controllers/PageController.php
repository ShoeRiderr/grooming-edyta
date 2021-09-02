<?php

namespace App\Http\Controllers;

use App\Enums\ContentType;
use App\Models\AboutCompany;
use App\Models\Contact;
use App\Models\DogHotel;
use App\Models\Grooming;
use App\Models\Handling;
use App\Models\Physiotherapy;
use App\Models\Post;
use Carbon\Carbon;

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
            'aboutCompany' => $aboutCompany,
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
            'contact' => $contact,
        ]);
    }

    public function dogHotel()
    {
        $images = [];

        if ($this->dogHotelModel()->images) {
            $images = $this->dogHotelModel()->images()->pluck('file_pathname')->toArray();
        }

        return view('dog-hotel', [
            'dogHotel' => $this->dogHotelModel(),
            'images'   => $this->getImages($images),
        ]);
    }

    public function grooming()
    {
        $images = [];

        if ($this->groomingModel()->images) {
            $images = $this->groomingModel()->images()->pluck('file_pathname')->toArray();
        }

        return view('grooming', [
            'grooming' => $this->groomingModel(),
            'images'   => $this->getImages($images),
        ]);
    }

    public function handling()
    {
        $images = [];

        if ($this->handlingModel()->images) {
            $images = $this->handlingModel()->images()->pluck('file_pathname')->toArray();
        }

        return view('handling', [
            'handling' => $this->handlingModel(),
            'images'   => $this->getImages($images),
        ]);
    }

    public function physiotherapy()
    {
        $images = [];

        if ($this->physiotherapyModel()->images) {
            $images = $this->physiotherapyModel()->images()->pluck('file_pathname')->toArray();
        }

        return view('physiotherapy', [
            'physiotherapy' => $this->physiotherapyModel(),
            'images'        => $this->getImages($images),
        ]);
    }

    public function news()
    {
        return view('news', [
            'dogHotel'      => $this->dogHotelModel()->posts()->where('end_date', '>', Carbon::now())->get(),
            'grooming'      => $this->groomingModel()->posts()->where('end_date', '>', Carbon::now())->get(),
            'handling'      => $this->handlingModel()->posts()->where('end_date', '>', Carbon::now())->get(),
            'physiotherapy' => $this->physiotherapyModel()->posts()->where('end_date', '>', Carbon::now())->get(),
        ]);
    }

    public function post(Post $post)
    {
        return view('post', [
            'post' => $post,
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

    private function getImages(array $images)
    {
        $result = [];

        foreach ($images as $image) {
            array_push($result, sprintf('%s/storage/%s', url(''), $image));
        }

        return $result;
    }
}
