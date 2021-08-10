<?php

namespace App\Http\Controllers\Json\Post;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Grooming;
use App\Models\Post;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\ConnectionInterface as Connection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class GroomingController extends Controller
{
    private ?Grooming $grooming;

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->grooming = Grooming::where('type', ContentType::CONSTANT)->first();
    }

    /**
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function index()
    {
        if (!$this->grooming) {
            return new JsonResponse([], 400);
        }

        return PostResource::collection($this->grooming->posts()->with('image')->get());
    }

 
    /**
     * @param   \App\Models\Post    $post
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function show(Post $post)
    {
        if (!$this->grooming) {
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
        if (!$this->grooming) {
            return new JsonResponse([], 400);
        }

        $post = $this->connection->transaction(function () use ($request) {
            $post = $this->grooming->posts()->create([
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            foreach ($request->input('image') as $index => $attributes) {
                /** @var \Illuminate\Http\UploadedFile */
                $file = $request->file("image.{$index}.file");
                $pathname = $file->store("public");

                $image = $post->image()->make([
                    'file_pathname' => $pathname,
                    'name'          => Arr::get($attributes, 'name'),
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
        /**
         * @todo delete file from storage
         */
        if (!$this->grooming) {
            return new JsonResponse([], 400);
        }

        $this->connection->transaction(function () use ($request, $post) {
            $post->update([
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            foreach ($request->input('image') as $index => $attributes) {
                /** @var \Illuminate\Http\UploadedFile */
                $file = $request->file("image.{$index}.file");
                $pathname = $file->store("public");

                $image = $post->image()->update([
                    'file_pathname' => $pathname,
                    'name'          => Arr::get($attributes, 'name'),
                    'description'   => Arr::get($attributes, 'description'),
                ]);
            }

            return $post;
        });

        return PostResource::make($post);
    }

    /**
     * @param   \App\Models\Post    $post
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        if (!$this->grooming) {
            return new JsonResponse([], 400);
        }

        Storage::delete($post->image->file_pathname);

        $this->grooming->posts()->where('id', $post->id)->delete();

        return new JsonResponse('', 200);
    }
}
