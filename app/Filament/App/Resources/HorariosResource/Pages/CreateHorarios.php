<?php

namespace App\Filament\App\Resources\HorariosResource\Pages;

use App\Filament\App\Resources\HorariosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHorarios extends CreateRecord
{
    protected static string $resource = HorariosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
