<?php

namespace App\Filament\App\Resources\CalendariosResource\Pages;

use App\Filament\App\Resources\CalendariosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCalendarios extends CreateRecord
{
    protected static string $resource = CalendariosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
