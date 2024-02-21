<?php

namespace App\Filament\App\Resources\EncarregadosResource\Pages;

use App\Filament\App\Resources\EncarregadosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEncarregados extends CreateRecord
{
    protected static string $resource = EncarregadosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
