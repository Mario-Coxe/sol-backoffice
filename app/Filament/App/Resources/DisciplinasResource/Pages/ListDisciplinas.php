<?php

namespace App\Filament\App\Resources\DisciplinasResource\Pages;

use App\Filament\App\Resources\DisciplinasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDisciplinas extends ListRecords
{
    protected static string $resource = DisciplinasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
