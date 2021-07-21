<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroomingImage extends Model
{
    use HasFactory;

    protected $fillablse = [
        'dog_race',
        'dog_name',
    ];

    public function images()
    {
        return $this->morphMany(Image::class);
    }
}
