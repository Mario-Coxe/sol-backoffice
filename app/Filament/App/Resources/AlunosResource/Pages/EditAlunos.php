<?php

namespace App\Filament\App\Resources\AlunosResource\Pages;

use App\Filament\App\Resources\AlunosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlunos extends EditRecord
{
    protected static string $resource = AlunosResource::class;

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
