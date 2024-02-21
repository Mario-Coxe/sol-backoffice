<?php

namespace App\Filament\App\Resources\AnosLetivosResource\Pages;

use App\Filament\App\Resources\AnosLetivosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnosLetivos extends CreateRecord
{
    protected static string $resource = AnosLetivosResource::class;

    public function handle()
    {
        parent::handle();

        return redirect(AnosLetivosResource::route('/'));
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
