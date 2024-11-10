<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movieId',
        'full_name',
        'movieName',
        'movieType',
        'country',
        'season_number',
        'episode_number',
        'episode_name',
        'overview',
        'air_date',
        'imageUrl',
        'status',
        'download_url',
        'approved_at',
    ];
}
