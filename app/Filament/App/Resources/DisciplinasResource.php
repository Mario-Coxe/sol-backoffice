<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\DisciplinasResource\Pages;
use App\Filament\App\Resources\DisciplinasResource\RelationManagers;
use App\Models\Disciplinas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;


class DisciplinasResource extends Resource
{
    protected static ?string $model = Disciplinas::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Escola';

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        $currentTeam = $user ? $user->teams->first() : null;


        $professor = $currentTeam
            ? $currentTeam->professores->pluck('name', 'id')->toArray()
            : [];
        $course = $currentTeam
            ? $currentTeam->cursos->pluck('name', 'id')->toArray()
            : [];


        return $form
            ->schema([
                Forms\Components\Section::make('Relação')
                    ->schema([
                        Forms\Components\Select::make('responsible_professor_id')
                            ->label("Professor Responsável")
                            ->options($professor)
                            ->required(),
                        Forms\Components\Select::make('course_id')
                            ->label("Curso")
                            ->options($course)
                            ->required(),
                        Forms\Components\TextInput::make('abbreviation')
                            ->label("Abreviatura da Disciplina")
                            ->maxLength(3)
                            ->required(),
                    ])->columns(3),
                Forms\Components\Section::make('Informações')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label("Disciplina")
                            ->required(),
                        Forms\Components\Select::make('is_active')
                            ->label("Estado")
                            ->options([
                                '1' => 'Activo',
                                '0' => 'Desativo',
                            ]),
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
                Tables\Columns\TextColumn::make('cursos.name')
                    ->label("Ano Letivo")
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label("Estado")
                    ->boolean(),
                Tables\Columns\TextColumn::make('abbreviation')
                    ->label("Disciplina abreviatura")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
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
                                ->title('Disciplina Editada.')
                                ->body('A Disciplina foi editado com sucesso.')

                        ),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Disciplina Eliminada.')
                                ->body('A Disciplina foi excluído com sucesso.')

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
            'index' => Pages\ListDisciplinas::route('/'),
            'create' => Pages\CreateDisciplinas::route('/create'),
            'edit' => Pages\EditDisciplinas::route('/{record}/edit'),
        ];
    }
}