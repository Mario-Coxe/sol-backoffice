<?php

namespace App\Filament\Resources\TipoDeProdutosResource\Pages;

use App\Filament\Resources\TipoDeProdutosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoDeProdutos extends ListRecords
{
    protected static string $resource = TipoDeProdutosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
