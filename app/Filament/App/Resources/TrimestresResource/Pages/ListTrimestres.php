<?php

namespace App\Filament\App\Resources\TrimestresResource\Pages;

use App\Filament\App\Resources\TrimestresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrimestres extends ListRecords
{
    protected static string $resource = TrimestresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
