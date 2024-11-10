<?php

namespace App\Filament\Resources\SeasonsResource\Pages;

use App\Filament\Resources\SeasonsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeasons extends EditRecord
{
    protected static string $resource = SeasonsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
