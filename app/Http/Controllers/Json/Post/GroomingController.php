<?php

namespace App\Http\Controllers\Json\Post;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Grooming;
use App\Models\Post;
use App\Models\Meta;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\ConnectionInterface as Connection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GroomingController extends Controller
{
    private ?Grooming $grooming;

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->grooming   = Grooming::firstOrCreate(
            ['type' => ContentType::CONSTANT],
            [
                'title'   => '',
                'content' => '',
                'type'    => ContentType::CONSTANT,
            ]
        );
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

        $post->load('image', 'metas');

        return PostResource::make($post);
    }

    /**
     * @param   \App\Http\Requests\Post\StoreRequest  $request
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function store(StoreRequest $request)
    {
        if (!$this->grooming) {
            return new JsonResponse([], 400);
        }

        $post = $this->connection->transaction(function () use ($request) {
            $post = $this->grooming->posts()->create([
                'title'    => $request->input('title'),
                'end_date' => sprintf('%s %s', $request->input('date'), $request->input('time')),
                'content'  => $request->input('content'),
                'description'  => $request->input('description'),
            ]);

            foreach ($request->input('image') as $index => $attributes) {
                /** @var \Illuminate\Http\UploadedFile */
                $file = $request->file("image.{$index}.file");
                $file->move(public_path().'/storage/', $img = 'img_'.time().'.jpg');

                $image = $post->image()->make([
                    'title' => Arr::get($attributes, 'title'),
                    'file_pathname' => $img,
                    'name'          => Arr::get($attributes, 'name'),
                    'description'   => Arr::get($attributes, 'description'),
                ]);

                $image->save();
            }

            foreach($request->input('metas') as $meta) {
                $post->metas()->create(
                    [
                        'name' => Arr::get($meta, 'name'),
                    ]
                );
            }

            return $post;
        });

        return PostResource::make($post);
    }

    /**
     * @param   \App\Http\Requests\Post\UpdateRequest  $request
     * @param   \App\Models\Post    $post
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function update(UpdateRequest $request, Post $post): Responsable
    {
        if (!$this->grooming) {
            return new JsonResponse([], 400);
        }

        $this->connection->transaction(function () use ($request, $post) {
            $post->update([
                'title'    => $request->input('title'),
                'end_date' => sprintf('%s %s', $request->input('date'), $request->input('time')),
                'content'  => $request->input('content'),
                'description'  => $request->input('description'),
            ]);

            if ($request->input('image') !== null) {
                File::delete(public_path().'/storage/' . $post->image->file_pathname);

                foreach ($request->input('image') as $index => $attributes) {
                    /** @var \Illuminate\Http\UploadedFile */
                    $file = $request->file("image.{$index}.file");
                    $file->move(public_path().'/storage/', $img = 'img_'.time().'.jpg');

                    $image = $post->image()->update([
                        'title' => Arr::get($attributes, 'title'),
                        'file_pathname' => $img,
                        'name'          => Arr::get($attributes, 'name'),
                        'description'   => Arr::get($attributes, 'description'),
                    ]);
                }
            }

            $post->metas->each(function (Meta $meta) use ($request, $post) {
                if (!in_array($meta->id, $request->input('metas.*.id'))) {
                    $post->metas()->where('id', $meta->id)->delete();
                }
            });

            foreach($request->input('metas') as $meta) {
                $post->metas()->updateOrCreate(
                    [
                        'id' => Arr::get($meta, 'id'),
                    ],
                    [
                        'name' => Arr::get($meta, 'name'),
                    ]
                );
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

        File::delete(public_path().'/storage/' . $post->image->file_pathname);

        $relatedPost = $this->grooming->posts->where('id', $post->id)->first();

        $relatedPost->image->delete();

        $relatedPost->delete();

        return new JsonResponse('', 200);
    }
}
