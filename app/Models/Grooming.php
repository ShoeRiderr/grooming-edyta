<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grooming extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'type',
    ];

    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
