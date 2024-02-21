<?php

namespace App\Filament\App\Resources\TarefasResource\Pages;

use App\Filament\App\Resources\TarefasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTarefas extends EditRecord
{
    protected static string $resource = TarefasResource::class;

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
