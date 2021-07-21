<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Models\GroomingImage;
use App\Http\Resources\GroomingImageResource;
use App\Http\Requests\GroomingImage\StoreRequest;
use Illuminate\Contracts\Support\Responsable;

class GroomingImageController extends Controller
{
    public function store(StoreRequest $request): Responsable
    {
        $groomingImage = GroomingImage::create($request->only([
            'dog_race',
            'dog_name'
        ]));

        $file_name = time().'_'.$request->file->getClientOriginalName();
        $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
        
        $groomingImage->image()->create([
            'name' => time().'_'.$request->file->getClientOriginalName(),
            'path' => '/storage/' . $file_path
        ]);

        return GroomingImageResource::make($groomingImage);
    }
}
