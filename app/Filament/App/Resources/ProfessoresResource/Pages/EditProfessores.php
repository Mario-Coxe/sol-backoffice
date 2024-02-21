<?php

namespace App\Filament\App\Resources\ProfessoresResource\Pages;

use App\Filament\App\Resources\ProfessoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessores extends EditRecord
{
    protected static string $resource = ProfessoresResource::class;

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
