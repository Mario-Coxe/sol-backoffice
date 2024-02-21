<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CursosResource\Pages;
use App\Filament\App\Resources\CursosResource\RelationManagers;
use App\Models\Cursos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;


class CursosResource extends Resource
{
    protected static ?string $model = Cursos::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Escola';

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        $currentTeam = $user ? $user->teams->first() : null;


        $academic_year = $currentTeam
            ? $currentTeam->anosLetivos->pluck('name', 'id')->toArray()
            : [];

        $responsible_professor = $currentTeam
            ? $currentTeam->professores->pluck('name', 'id')->toArray()
            : [];


        return $form
            ->schema([
                //

                Forms\Components\Section::make('Relações')
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\Select::make('academic_year_id')
                                    ->label("Ano Letivo")
                                    ->options($academic_year)
                                    ->required(),
                                Forms\Components\Select::make('responsible_professor_id')
                                    ->label("Professor Responsável")
                                    ->options($responsible_professor)
                                    ->required(),
                            ]),
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
                            ->label("Curso")
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label("Descrição")
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Nome")
                    ->searchable(),
                Tables\Columns\TextColumn::make('professores.name')
                    ->label("Professor Responsável")
                    ->searchable(),
                Tables\Columns\TextColumn::make('anosLetivos.name')
                    ->label("Ano Letivo")
                    ->searchable(),
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
                                ->title('Curso Editado.')
                                ->body('O Curso foi editado com sucesso.')

                        ),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Curso Eliminado.')
                                ->body('O Curso foi excluído com sucesso.')
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
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCursos::route('/create'),
            'edit' => Pages\EditCursos::route('/{record}/edit'),
        ];
    }
}
