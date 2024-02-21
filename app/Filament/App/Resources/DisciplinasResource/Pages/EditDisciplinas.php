<?php

namespace App\Filament\App\Resources\DisciplinasResource\Pages;

use App\Filament\App\Resources\DisciplinasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisciplinas extends EditRecord
{
    protected static string $resource = DisciplinasResource::class;

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
