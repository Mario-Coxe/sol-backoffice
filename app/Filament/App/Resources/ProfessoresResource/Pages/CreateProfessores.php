<?php

namespace App\Filament\App\Resources\ProfessoresResource\Pages;

use App\Filament\App\Resources\ProfessoresResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfessores extends CreateRecord
{
    protected static string $resource = ProfessoresResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
