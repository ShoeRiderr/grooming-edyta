<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'end_date',
        'content',
        'description',
    ];

    public function postable()
    {
        return $this->morphTo();
    }

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
