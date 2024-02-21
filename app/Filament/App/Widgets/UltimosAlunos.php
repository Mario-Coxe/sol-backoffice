<?php

namespace App\Filament\App\Widgets;

use App\Models\Alunos;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Facades\Filament;

class UltimosAlunos extends BaseWidget
{
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {
        return $table
            ->query(Alunos::query()->whereBelongsTo(Filament::getTenant()))
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('turmas.name'),
                Tables\Columns\TextColumn::make('encarregados.name'),
            ]);
    }
}
