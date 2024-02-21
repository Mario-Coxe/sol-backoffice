<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\AnosLetivosResource\Pages;
use App\Filament\App\Resources\AnosLetivosResource\RelationManagers;
use App\Models\AnosLetivos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;


class AnosLetivosResource extends Resource
{
    protected static ?string $model = AnosLetivos::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Escola';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Tempo')
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label("Data De Início")
                            ->native(true)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\DatePicker::make('end_date')
                            ->label("Data De Fim")
                            ->native(true)
                            ->displayFormat('d/m/Y')
                    ])->columns(2),
                Forms\Components\Section::make('Informações')
                    ->schema([
                        Forms\Components\Select::make('is_active')
                            ->label("Estado")
                            ->options([
                                '1' => 'Activo',
                                '0' => 'Desativo',
                            ]),
                        Forms\Components\TextInput::make('name')
                            ->label("Ano Letivo")
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Ano Letivo")
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->searchable()
                    ->label("início"),
                Tables\Columns\TextColumn::make('end_date')
                    ->searchable()
                    ->label("Fim"),

                Tables\Columns\IconColumn::make('is_active')
                    ->label("Estado")
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])

            ->actions([

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Ano Letivo Editado.')
                                ->body('O Ano Letivo foi editado com sucesso.')

                        ),

                ]),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Ano Letivo Eliminado.')
                                ->body('O Ano Letivo foi excluído com sucesso.')

                        )
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Criado')
                            ->body('Ano Letivo foi Criado com sucesso.')
                    )
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
            'index' => Pages\ListAnosLetivos::route('/'),
            'create' => Pages\CreateAnosLetivos::route('/create'),
            'edit' => Pages\EditAnosLetivos::route('/{record}/edit'),
        ];
    }
}
