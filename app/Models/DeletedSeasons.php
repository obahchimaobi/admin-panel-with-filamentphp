<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedSeasons extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'movieId',
        'movieName',
        'season_number',
        'episode_number',
        'episode_name',
    ];
}
