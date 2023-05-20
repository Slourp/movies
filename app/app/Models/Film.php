<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'overview',
        'poster_path',
        'backdrop_path',
        'budget',
        'popularity',
        'release_date',
        'video',
        'vote_average',
        'vote_count',
        'original_language',
        'original_title',
        'homepage',
        'imdb_id',
        'revenue',
        'runtime',
        'status',
        'tagline',
    ];

    protected $casts = [
        'budget' => 'integer',
        'popularity' => 'float',
        'release_date' => 'date',
        'video' => 'boolean',
        'vote_average' => 'float',
        'vote_count' => 'integer',
        'revenue' => 'integer',
        'runtime' => 'integer',
    ];
}
