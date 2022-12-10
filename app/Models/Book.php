<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $casts = [
        'generos' => 'array'
    ];

    protected $dates = [
        'publication_date'
    ];

    protected $guarded = [];
}
