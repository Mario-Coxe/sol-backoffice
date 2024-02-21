<?php

namespace App\Filament\App\Resources\CalendariosResource\Pages;

use App\Filament\App\Resources\CalendariosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalendarios extends ListRecords
{
    protected static string $resource = CalendariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
