<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movieId',
        'isAdult',
        'full_name',
        'originalTitleText',
        'imageUrl',
        'backdrop_path',
        'country',
        'language',
        'plotText',
        'releaseDate',
        'releaseYear',
        'aggregateRating',
        'titleType',
        'runtime',
        'genres',
        'trailer',
        'status',
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
