<?php

namespace App\Filament\App\Resources\TarefasResource\Pages;

use App\Filament\App\Resources\TarefasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTarefas extends ListRecords
{
    protected static string $resource = TarefasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
