<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CalendariosResource\Pages;
use App\Filament\App\Resources\CalendariosResource\RelationManagers;
use App\Models\Calendarios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;

class CalendariosResource extends Resource
{
    protected static ?string $model = Calendarios::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Escola';

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        $currentTeam = $user ? $user->teams->first() : null;


        $class = $currentTeam
            ? $currentTeam->turmas->pluck('name', 'id')->toArray()
            : [];


        return $form
            ->schema([
                Forms\Components\Section::make('Relações')
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\Select::make('class_id')
                                    ->label("Turma")
                                    ->options($class)
                                    ->required(),
                            ]),
                    ]),
                Forms\Components\Section::make('Informações')
                    ->schema([
                        Forms\Components\Select::make('is_active')
                            ->label("Estado")
                            ->options([
                                '1' => 'Activo',
                                '0' => 'Desativo',
                            ]),
                        Forms\Components\DatePicker::make('data_day')
                            ->label("Data")
                            ->native(true)
                    ])->columns(2),
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label("Descrição")
                            ->maxLength(800),
                    ]),


            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('turmas.name')
                    ->label("Turma")
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_day')
                    ->label("Data")
                    ->searchable()
                    ->date(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label("Estado")
                    ->boolean(),
                Tables\Columns\TextColumn::make('description')
                    ->label("Descrição")
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                                ->title('Calendário Editado.')
                                ->body('O Calendário foi editado com sucesso.')

                        ),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Calendário Eliminado.')
                                ->body('O Calendário foi excluído com sucesso.')
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
            'index' => Pages\ListCalendarios::route('/'),
            'create' => Pages\CreateCalendarios::route('/create'),
            'edit' => Pages\EditCalendarios::route('/{record}/edit'),
        ];
    }
}
