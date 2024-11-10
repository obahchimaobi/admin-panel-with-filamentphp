<?php

namespace App\Filament\Resources\PendingMoviesResource\Pages;

use App\Filament\Resources\PendingMoviesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingMovies extends EditRecord
{
    protected static string $resource = PendingMoviesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
