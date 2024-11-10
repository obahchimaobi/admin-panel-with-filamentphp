<?php

namespace App\Filament\Resources\PendingSeriesResource\Pages;

use App\Filament\Resources\PendingSeriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendingSeries extends ListRecords
{
    protected static string $resource = PendingSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
