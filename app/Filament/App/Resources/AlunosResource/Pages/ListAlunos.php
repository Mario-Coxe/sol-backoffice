<?php

namespace App\Filament\App\Resources\AlunosResource\Pages;

use App\Filament\App\Resources\AlunosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlunos extends ListRecords
{
    protected static string $resource = AlunosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
