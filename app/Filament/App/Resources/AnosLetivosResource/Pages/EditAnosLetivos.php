<?php

namespace App\Filament\App\Resources\AnosLetivosResource\Pages;

use App\Filament\App\Resources\AnosLetivosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnosLetivos extends EditRecord
{
    protected static string $resource = AnosLetivosResource::class;

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
