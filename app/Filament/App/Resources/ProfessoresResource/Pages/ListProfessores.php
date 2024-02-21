<?php

namespace App\Filament\App\Resources\ProfessoresResource\Pages;

use App\Filament\App\Resources\ProfessoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfessores extends ListRecords
{
    protected static string $resource = ProfessoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
