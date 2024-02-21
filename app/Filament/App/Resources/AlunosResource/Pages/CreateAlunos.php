<?php

namespace App\Filament\App\Resources\AlunosResource\Pages;

use App\Filament\App\Resources\AlunosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAlunos extends CreateRecord
{
    protected static string $resource = AlunosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
