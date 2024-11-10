<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seasons extends Model
{
    use HasFactory, Searchable, SoftDeletes;

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

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['full_name'] = $this->full_name;
        $array['releaseYear'] = $this->releaseYear;

        // Customize array...

        return $array;
    }
}
