<?php

namespace App\Filament\Resources\PendingSeasonsResource\Pages;

use App\Filament\Resources\PendingSeasonsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingSeasons extends EditRecord
{
    protected static string $resource = PendingSeasonsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
