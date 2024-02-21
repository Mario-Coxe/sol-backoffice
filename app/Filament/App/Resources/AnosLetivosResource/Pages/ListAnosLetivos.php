<?php

namespace App\Filament\App\Resources\AnosLetivosResource\Pages;

use App\Filament\App\Resources\AnosLetivosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnosLetivos extends ListRecords
{
    protected static string $resource = AnosLetivosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
