<?php

namespace App\Filament\Resources\AgenciasResource\Pages;

use App\Filament\Resources\AgenciasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgencias extends ListRecords
{
    protected static string $resource = AgenciasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
