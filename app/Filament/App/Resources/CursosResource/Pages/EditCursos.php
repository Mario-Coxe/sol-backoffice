<?php

namespace App\Filament\App\Resources\CursosResource\Pages;

use App\Filament\App\Resources\CursosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCursos extends EditRecord
{
    protected static string $resource = CursosResource::class;

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
