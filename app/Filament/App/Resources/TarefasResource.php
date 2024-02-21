<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TarefasResource\Pages;
use App\Filament\App\Resources\TarefasResource\RelationManagers;
use App\Models\Tarefas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TarefasResource extends Resource
{
    protected static ?string $model = Tarefas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestão de Professores';


    public static function form(Form $form): Form
    {
        $user = Auth::user();

        $currentTeam = $user ? $user->teams->first() : null;


        $class = $currentTeam
            ? $currentTeam->turmas->pluck('name', 'id')->toArray()
            : [];

        $subject = $currentTeam
            ? $currentTeam->disciplinas->pluck('name', 'id')->toArray()
            : [];

        $professsor = $currentTeam
            ? $currentTeam->professores->pluck('name', 'id')->toArray()
            : [];

        return $form
            ->schema([
                Forms\Components\Section::make('Relação')
                    ->schema([
                        Forms\Components\Select::make('class_id')
                            ->label("Turma")
                            ->options($class)
                            ->required(),
                        Forms\Components\Select::make('subject_id')
                            ->label("Dsiciplina")
                            ->options($subject)
                            ->required(),
                        Forms\Components\Select::make('professor_id')
                            ->label("Professor")
                            ->options($professsor)
                            ->required(),
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
                            ->label("Descrição")
                            ->autosize(),
                    ]),
                    Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\DatePicker::make('due_date')
                            ->label("Data De Entrega")
                            ->native(true)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('turmas.name')
                    ->searchable()
                    ->label("Turma"),
                Tables\Columns\TextColumn::make('professores.name')
                    ->searchable()
                    ->label("Professor"),
                Tables\Columns\TextColumn::make('disciplinas.name')
                    ->searchable()
                    ->label("Disciplina"),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(20)
                    ->label("Disciplina"),
                Tables\Columns\TextColumn::make('due_date')
                    ->searchable()
                    ->label("Data de Entrega"),
                Tables\Columns\IconColumn::make('is_active')
                    ->label("Estado")
                    ->boolean(),
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
                                ->title('Tarefa/a Editado.')
                                ->body('O Tarefa/a foi editado com sucesso.')
                        ),

                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Criado')
                                ->body('Tarefa/a  foi Criado com sucesso.')
                        )
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
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
            'index' => Pages\ListTarefas::route('/'),
            'create' => Pages\CreateTarefas::route('/create'),
            'edit' => Pages\EditTarefas::route('/{record}/edit'),
        ];
    }
}
