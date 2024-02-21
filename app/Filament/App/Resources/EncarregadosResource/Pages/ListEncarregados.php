<?php

namespace App\Filament\App\Resources\EncarregadosResource\Pages;

use App\Filament\App\Resources\EncarregadosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEncarregados extends ListRecords
{
    protected static string $resource = EncarregadosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
