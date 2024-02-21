<?php

namespace App\Filament\App\Resources\CursosResource\Pages;

use App\Filament\App\Resources\CursosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCursos extends CreateRecord
{
    protected static string $resource = CursosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
