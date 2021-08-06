<?php

namespace App\Http\Controllers\Json\Post;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Physiotherapy;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class PhysiotherapyController extends Controller
{
    private ?Physiotherapy $physiotherapy;

    public function __construct()
    {
        $this->physiotherapy = Physiotherapy::where('type', ContentType::CONSTANT)->first();
    }

    /**
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function index()
    {
        if (!$this->physiotherapy) {
            return new JsonResponse([], 400);
        }

        return PostResource::collection($this->physiotherapy->posts()->with('image')->get());
    }

    /**
     * @param   \App\Models\Post    $post
     * @return  \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Support\Responsable
     */
    public function show(Post $post)
    {
        if (!$this->physiotherapy) {
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
        if (!$this->physiotherapy) {
            return new JsonResponse([], 404);
        }

        $post = $this->physiotherapy->posts()->create([
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
        if (!$this->physiotherapy) {
            return new JsonResponse([], 404);
        }

        $this->physiotherapy->posts->where('id', $post->id)->update([
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
        if (!$this->physiotherapy) {
            return new JsonResponse([], 404);
        }

        $this->physiotherapy->posts->where('id', $post->id)->delete();

        return new JsonResponse('', 200);
    }
}
