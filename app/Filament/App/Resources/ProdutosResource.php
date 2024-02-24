<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ProdutosResource\Pages;
use App\Filament\App\Resources\ProdutosResource\RelationManagers;
use App\Models\Produtos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\TipoDeProduto;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;


class ProdutosResource extends Resource
{
    protected static ?string $model = Produtos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        $typeOfProduct = TipoDeProduto::pluck('name', 'id')->toArray();


        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('id_typeOfProdut')
                    ->label("Tipo De Produto")
                    ->multiple(false)
                    ->preload()
                    ->options($typeOfProduct),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Nome")
                    ->searchable(),
                TextColumn::make('tipoProdutos.name')
                    ->label("Tipo De Produto")
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProdutos::route('/create'),
            'edit' => Pages\EditProdutos::route('/{record}/edit'),
        ];
    }
}