<?php

namespace App\Filament\App\Resources\EncarregadosResource\Pages;

use App\Filament\App\Resources\EncarregadosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEncarregados extends EditRecord
{
    protected static string $resource = EncarregadosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
