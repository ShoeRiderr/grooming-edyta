<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Handling extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'description',
        'type',
    ];

    protected $table = 'handling';

    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
