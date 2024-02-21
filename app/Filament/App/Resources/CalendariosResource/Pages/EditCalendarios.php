<?php

namespace App\Filament\App\Resources\CalendariosResource\Pages;

use App\Filament\App\Resources\CalendariosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalendarios extends EditRecord
{
    protected static string $resource = CalendariosResource::class;

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
