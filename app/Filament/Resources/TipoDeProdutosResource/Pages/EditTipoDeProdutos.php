<?php

namespace App\Filament\Resources\TipoDeProdutosResource\Pages;

use App\Filament\Resources\TipoDeProdutosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoDeProdutos extends EditRecord
{
    protected static string $resource = TipoDeProdutosResource::class;

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