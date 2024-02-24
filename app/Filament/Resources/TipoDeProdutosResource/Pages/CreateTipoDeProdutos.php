<?php

namespace App\Filament\Resources\TipoDeProdutosResource\Pages;

use App\Filament\Resources\TipoDeProdutosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTipoDeProdutos extends CreateRecord
{
    protected static string $resource = TipoDeProdutosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}