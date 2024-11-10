<?php

namespace App\Filament\Resources\MoviesResource\Pages;

use App\Filament\Resources\MoviesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMovies extends CreateRecord
{
    protected static string $resource = MoviesResource::class;
}
