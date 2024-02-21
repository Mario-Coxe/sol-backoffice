<?php

namespace App\Filament\App\Resources\EventosResource\Pages;

use App\Filament\App\Resources\EventosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventos extends EditRecord
{
    protected static string $resource = EventosResource::class;

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
