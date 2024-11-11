<?php

namespace App\Models;

use Filament\Panel;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seasons extends Model implements  FilamentUser, HasAvatar
{
    use HasFactory, Searchable, SoftDeletes;

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return str_ends_with($this->email, '@gmail.com') && $this->hasVerifiedEmail();
        }
 
        return true;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        // return asset('images/');
    }

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
