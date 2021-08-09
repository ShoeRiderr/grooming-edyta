<?php

namespace App\Http\Controllers\Json\Post;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\DogHotel;
use App\Models\Post;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\ConnectionInterface as Connection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class DogHotelController extends Controller
{
    private ?DogHotel $dogHotel;

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->dogHotel = DogHotel::where('type', ContentType::CONSTANT)->first();
    }

    /**
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function index()
    {
        if (!$this->dogHotel) {
            return new JsonResponse([], 400);
        }

        return PostResource::collection($this->dogHotel->posts()->with('image')->get());
    }

 
    /**
     * @param   \App\Models\Post    $post
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function show(Post $post)
    {
        if (!$this->dogHotel) {
            return new JsonResponse([], 400);
        }

        $post->load('image');

        return PostResource::make($post);
    }



    /**
     * @param   \App\Http\Requests\PostRequest  $request
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function store(PostRequest $request)
    {
        // dd($request->all());
        if (!$this->dogHotel) {
            return new JsonResponse([], 400);
        }

        $post = $this->connection->transaction(function () use ($request) {
            $post = $this->dogHotel->posts()->create([
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            foreach ($request->input('image') as $index => $attributes) {
                /** @var \Illuminate\Http\UploadedFile */
                $file = $request->file("image.{$index}.file");
                $pathname = $file->store("public/images/{$post->id}");

                $image = $post->image()->make([
                    'file_pathname' => $pathname,
                    'name'          => Arr::get($attributes, 'name'),
                    'extension'     => Arr::get($attributes, 'extension'),
                    'source'        => $file,
                    'description'   => Arr::get($attributes, 'description'),
                ]);

                $image->save();
            }

            return $post;
        });

        return PostResource::make($post);
    }

    /**
     * @param   \App\Http\Requests\PostRequest  $request
     * @param   \App\Models\Post    $post
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function update(PostRequest $request, Post $post): Responsable
    {
        if (!$this->dogHotel) {
            return new JsonResponse([], 400);
        }

        $this->dogHotel->posts->where('id', $post->id)->update([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return PostResource::make($post);
    }

    /**
     * @param   \App\Models\Post    $post
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        if (!$this->dogHotel) {
            return new JsonResponse([], 400);
        }

        $this->dogHotel->posts->where('id', $post->id)->delete();

        return new JsonResponse('', 200);
    }

    private function showImage($postImage)
    {
        $file = Storage::get($postImage->path_to_file); 
        return new Response($file, 200, [ 'Content-type' => 'application/pdf']); 
    }
}
