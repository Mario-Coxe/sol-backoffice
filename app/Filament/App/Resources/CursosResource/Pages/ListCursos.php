<?php

namespace App\Filament\App\Resources\CursosResource\Pages;

use App\Filament\App\Resources\CursosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCursos extends ListRecords
{
    protected static string $resource = CursosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
