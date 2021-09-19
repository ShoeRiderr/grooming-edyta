<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'description',
        'type',
    ];

    protected $table = 'contact';

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
    }
}
