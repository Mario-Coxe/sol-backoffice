<?php

namespace App\Filament\App\Resources\TurmasResource\Pages;

use App\Filament\App\Resources\TurmasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTurmas extends CreateRecord
{
    protected static string $resource = TurmasResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
