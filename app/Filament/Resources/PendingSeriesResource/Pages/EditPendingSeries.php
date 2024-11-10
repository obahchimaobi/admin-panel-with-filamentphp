<?php

namespace App\Filament\Resources\PendingSeriesResource\Pages;

use App\Filament\Resources\PendingSeriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingSeries extends EditRecord
{
    protected static string $resource = PendingSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
