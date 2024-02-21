<?php

namespace App\Filament\App\Resources\TarefasResource\Pages;

use App\Filament\App\Resources\TarefasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTarefas extends CreateRecord
{
    protected static string $resource = TarefasResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
