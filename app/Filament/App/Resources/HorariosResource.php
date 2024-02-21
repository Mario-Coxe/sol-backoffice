<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\HorariosResource\Pages;
use App\Filament\App\Resources\HorariosResource\RelationManagers;
use App\Models\Horarios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class HorariosResource extends Resource
{
    protected static ?string $model = Horarios::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Gestão de Turmas';

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        $currentTeam = $user ? $user->teams->first() : null;


        $quarter = $currentTeam
            ? $currentTeam->trimestres->pluck('name', 'id')->toArray()
            : [];

        $subject = $currentTeam
            ? $currentTeam->disciplinas->pluck('name', 'id')->toArray()
            : [];

        $class = $currentTeam
            ? $currentTeam->turmas->pluck('name', 'id')->toArray()
            : [];


        return $form
            ->schema([
                Forms\Components\Section::make('Tempo')
                    ->schema([
                        Forms\Components\TimePicker::make('start_time')
                            ->label("Início")
                            ->prefix('Início')
                            ->suffix('Minutos/Horas')
                            ->seconds(false)
                            ->native(true),
                        Forms\Components\TimePicker::make('end_time')
                            ->label("Fim")
                            ->prefix('Fim')
                            ->seconds(false)
                            ->suffix('Minutos/Horas')
                            ->native(true),
                    ])->columns(2),
                Forms\Components\Section::make('Informações')
                    ->schema([
                        Forms\Components\Select::make('is_active')
                            ->label("Estado")
                            ->options([
                                '1' => 'Activo',
                                '0' => 'Desativo',
                            ]),
                        Forms\Components\Select::make('day_of_week')
                            ->label("Dia De Semana")
                            ->required()
                            ->options([
                                'Segunda' => 'Segunda-feira',
                                'Terça' => 'Terça-feira',
                                'Quarta' => 'Quarta-feira',
                                'Quinta' => 'Quinta-feira',
                                'Sexta' => 'Sexta-feira',
                                'Sábado' => 'Sábado',
                                'Domingo' => 'Domingo',
                            ]),
                    ])->columns(2),
                Forms\Components\Section::make('Relação')
                    ->schema([
                        Forms\Components\Select::make('class_id')
                            ->label("Turma")
                            ->options($class)
                            ->required(),
                        Forms\Components\Select::make('subjet_id')
                            ->label("Disciplina")
                            ->options($subject)
                            ->required(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('disciplinas.name')
                    ->label("Disciplina")
                    ->searchable(),
                Tables\Columns\TextColumn::make('turmas.name')
                    ->label("Turma")
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label("Dia de Semana")
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->searchable()
                    ->label("início"),
                Tables\Columns\TextColumn::make('end_time')
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
                                ->title('Horário Editado.')
                                ->body('O Horário foi editado com sucesso.')

                        ),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Horário Eliminado.')
                                ->body('O Horário foi excluído com sucesso.')

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
            'index' => Pages\ListHorarios::route('/'),
            'create' => Pages\CreateHorarios::route('/create'),
            'edit' => Pages\EditHorarios::route('/{record}/edit'),
        ];
    }
}