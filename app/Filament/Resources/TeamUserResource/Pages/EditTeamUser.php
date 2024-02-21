<?php

namespace App\Filament\Resources\TeamUserResource\Pages;

use App\Filament\Resources\TeamUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeamUser extends EditRecord
{
    protected static string $resource = TeamUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
