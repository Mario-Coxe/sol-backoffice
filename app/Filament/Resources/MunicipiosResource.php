<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MunicipiosResource\Pages;
use App\Filament\Resources\MunicipiosResource\RelationManagers;
use App\Models\Municipios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Provincias;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class MunicipiosResource extends Resource
{
    protected static ?string $model = Municipios::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $provinces = Provincias::pluck('name', 'id')->toArray();

        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label("Nome")
                                    ->required(),
                                Forms\Components\Select::make('id_province')
                                    ->label("Provicia")
                                    ->options($provinces)
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Nome")
                    ->searchable(),
                TextColumn::make('provincia.name')
                    ->label("Provincia")
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMunicipios::route('/'),
            'create' => Pages\CreateMunicipios::route('/create'),
            'edit' => Pages\EditMunicipios::route('/{record}/edit'),
        ];
    }
}