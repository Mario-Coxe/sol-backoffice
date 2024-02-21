<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TurmasResource\Pages;
use App\Filament\App\Resources\TurmasResource\RelationManagers;
use App\Models\Turmas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class TurmasResource extends Resource
{
    protected static ?string $model = Turmas::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $navigationGroup = 'Gestão de Turmas';

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

        $course = $currentTeam
            ? $currentTeam->cursos->pluck('name', 'id')->toArray()
            : [];

        return $form
            ->schema([
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
                                Forms\Components\Select::make('course_id')
                                    ->label("Curso")
                                    ->options($course)
                                    ->required(),
                            ]),
                    ])->columns(2),
                Forms\Components\Section::make('Informações')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label("Turma")
                            ->required(),
                        Forms\Components\TextInput::make('classroom_number')
                            ->maxLength(2)
                            ->label("Número da Sala"),
                        Forms\Components\Select::make('degree')
                            ->label("Classe Nº")
                            ->required()
                            ->options([
                                '10ª' => '10ª Classe',
                                '11ª' => '11ª Classe',
                                '12ª' => '12ª Classe',
                                '13ª' => '13ª Classe',
                            ]),
                        Forms\Components\Select::make('is_active')
                            ->label("Estado")
                            ->options([
                                '1' => 'Activo',
                                '0' => 'Desativo',
                            ]),
                    ])->columns(2),
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label("Descrição"),
                    ]),

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
                    ->label("Curso")
                    ->searchable(),
                Tables\Columns\TextColumn::make('anosLetivos.name')
                    ->label("Ano Letivo")
                    ->searchable(),
                Tables\Columns\TextColumn::make('classroom_number')
                    ->label("Sala Nº")
                    ->searchable(),
                Tables\Columns\TextColumn::make('degree')
                    ->label("Classe")
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
                                ->title('Turma Editada.')
                                ->body('A Turma foi editada com sucesso.')

                        ),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make()
                            ->successNotification(
                                Notification::make()
                                    ->success()
                                    ->title('Turma Eliminada.')
                                    ->body('A Turma foi excluído com sucesso.')

                            )
                    ]),
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
            'index' => Pages\ListTurmas::route('/'),
            'create' => Pages\CreateTurmas::route('/create'),
            'edit' => Pages\EditTurmas::route('/{record}/edit'),
        ];
    }
}
