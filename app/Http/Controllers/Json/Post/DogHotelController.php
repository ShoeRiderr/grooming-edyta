<?php

namespace App\Http\Controllers\Json\Post;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\DogHotel;
use App\Models\Post;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class DogHotelController extends Controller
{
    private ?DogHotel $dogHotel;

    public function __construct()
    {
        $this->dogHotel = DogHotel::where('type', ContentType::CONSTANT)->first();
    }

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        if (!$this->dogHotel) {
            return new JsonResponse([], 404);
        }

        return new JsonResponse($this->dogHotel->posts()->with('image')->paginate(10), 200);
    }

    /**
     * @param   \App\Models\Post    $post
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function show(Post $post)
    {
        if (!$this->dogHotel) {
            return new JsonResponse([], 404);
        }

        return PostResource::make($post);
    }

    /**
     * @param   \App\Http\Requests\PostRequest  $request
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function store(PostRequest $request)
    {
        if (!$this->dogHotel) {
            return new JsonResponse([], 404);
        }

        $post = $this->dogHotel->posts()->create([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

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
            return new JsonResponse([], 404);
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
            return new JsonResponse([], 404);
        }

        $this->dogHotel->posts->where('id', $post->id)->delete();

        return new JsonResponse('', 200);
    }
}
