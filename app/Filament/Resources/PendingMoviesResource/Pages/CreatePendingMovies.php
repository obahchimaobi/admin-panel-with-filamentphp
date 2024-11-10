<?php

namespace App\Filament\Resources\PendingMoviesResource\Pages;

use App\Filament\Resources\PendingMoviesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendingMovies extends CreateRecord
{
    protected static string $resource = PendingMoviesResource::class;
}
