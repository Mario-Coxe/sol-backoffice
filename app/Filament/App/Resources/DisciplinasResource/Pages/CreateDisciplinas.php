<?php

namespace App\Filament\App\Resources\DisciplinasResource\Pages;

use App\Filament\App\Resources\DisciplinasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDisciplinas extends CreateRecord
{
    protected static string $resource = DisciplinasResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
