<?php

namespace App\Filament\Resources\PendingSeasonsResource\Pages;

use App\Filament\Resources\PendingSeasonsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendingSeasons extends ListRecords
{
    protected static string $resource = PendingSeasonsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
