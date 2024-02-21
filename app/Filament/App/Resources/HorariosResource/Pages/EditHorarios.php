<?php

namespace App\Filament\App\Resources\HorariosResource\Pages;

use App\Filament\App\Resources\HorariosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHorarios extends EditRecord
{
    protected static string $resource = HorariosResource::class;

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
