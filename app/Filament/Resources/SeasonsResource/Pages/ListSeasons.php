<?php

namespace App\Filament\Resources\SeasonsResource\Pages;

use App\Filament\Resources\SeasonsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeasons extends ListRecords
{
    protected static string $resource = SeasonsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
