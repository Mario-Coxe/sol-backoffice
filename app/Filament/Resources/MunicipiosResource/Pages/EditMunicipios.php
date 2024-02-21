<?php

namespace App\Filament\Resources\MunicipiosResource\Pages;

use App\Filament\Resources\MunicipiosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMunicipios extends EditRecord
{
    protected static string $resource = MunicipiosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
