<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TrimestresResource\Pages;
use App\Filament\App\Resources\TrimestresResource\RelationManagers;
use App\Models\Trimestres;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;


class TrimestresResource extends Resource
{
    protected static ?string $model = Trimestres::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Escola';

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        $currentTeam = $user ? $user->teams->first() : null;


        $academic_year = $currentTeam
            ? $currentTeam->anosLetivos->pluck('name', 'id')->toArray()
            : [];

        /*
        echo '<script>';
        echo 'console.log("CURRENT TEAM: ", ' . json_encode($currentTeam) . ');';
        echo '</script>';
        */


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
                            ->label("Trimestre")
                            ->maxLength(1)
                            ->maxValue(3)
                    ])->columns(2),
                Forms\Components\Section::make('Ano Letivo')
                    ->schema([
                        Forms\Components\Select::make('academic_year_id')
                            ->label("Ano Letivo")
                            ->options($academic_year)
                            ->required(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                    ->label("Trimestre")
                    ->searchable(),
                Tables\Columns\TextColumn::make('anosLetivos.name')
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
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                                ->title('Trimestre Editado.')
                                ->body('O Trimestre foi editado com sucesso.')

                        ),
                ])

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Trimestre Eliminado.')
                                ->body('O Trimestre foi excluído com sucesso.')

                        )
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
            'index' => Pages\ListTrimestres::route('/'),
            'create' => Pages\CreateTrimestres::route('/create'),
            'edit' => Pages\EditTrimestres::route('/{record}/edit'),
        ];
    }
}
