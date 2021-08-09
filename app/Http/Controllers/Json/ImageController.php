<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Filesystem\Filesystem;

class ImageController extends Controller
{
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Image $image)
    {
        $file = Storage::get($image->file_pathname);
        return new Response($file, 200, [ 'Content-type' => 'image/png']); 
    }
}
