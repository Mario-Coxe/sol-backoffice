<?php

namespace App\Filament\App\Resources\TrimestresResource\Pages;

use App\Filament\App\Resources\TrimestresResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrimestres extends CreateRecord
{
    protected static string $resource = TrimestresResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
