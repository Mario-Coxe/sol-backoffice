<?php

namespace App\Filament\App\Resources\TurmasResource\Pages;

use App\Filament\App\Resources\TurmasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTurmas extends EditRecord
{
    protected static string $resource = TurmasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
