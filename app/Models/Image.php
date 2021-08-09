<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_pathname',
        'name',
        'extension',
        'source',
        'description',
    ];

    public $timestamps = false;

    public function imageable()
    {
        return $this->morphTo();
    }
}
