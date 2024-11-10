<?php

namespace App\Filament\Resources\PendingMoviesResource\Pages;

use App\Filament\Resources\PendingMoviesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendingMovies extends ListRecords
{
    protected static string $resource = PendingMoviesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
