<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutCompany extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'description',
        'type',
    ];

    protected $table = 'about_company';

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
    }
}
