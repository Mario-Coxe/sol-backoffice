<?php

namespace App\Filament\App\Resources\TrimestresResource\Pages;

use App\Filament\App\Resources\TrimestresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrimestres extends EditRecord
{
    protected static string $resource = TrimestresResource::class;

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
