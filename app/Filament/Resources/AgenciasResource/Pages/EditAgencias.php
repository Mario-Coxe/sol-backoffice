<?php

namespace App\Filament\Resources\AgenciasResource\Pages;

use App\Filament\Resources\AgenciasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgencias extends EditRecord
{
    protected static string $resource = AgenciasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
