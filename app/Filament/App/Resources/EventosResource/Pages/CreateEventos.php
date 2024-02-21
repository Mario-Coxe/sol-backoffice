<?php

namespace App\Filament\App\Resources\EventosResource\Pages;

use App\Filament\App\Resources\EventosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventos extends CreateRecord
{
    protected static string $resource = EventosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
