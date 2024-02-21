<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\AlunosResource\Pages;
use App\Filament\App\Resources\AlunosResource\RelationManagers;
use App\Models\Alunos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;


class AlunosResource extends Resource
{
    protected static ?string $model = Alunos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestão de Alunos';

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        $currentTeam = $user ? $user->teams->first() : null;


        $class = $currentTeam
            ? $currentTeam->turmas->pluck('name', 'id')->toArray()
            : [];

        $incharge = $currentTeam
            ? $currentTeam->encarregados->pluck('name', 'id')->toArray()
            : [];


        return $form
            ->schema([
                Forms\Components\Section::make('Informaçãoes')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label("Nome")
                            ->required(),
                        Forms\Components\TextInput::make('bi')
                            ->label("Número do BI")
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label("Email")
                            ->email(),
                        Forms\Components\TextInput::make('address')
                            ->label("Morada"),
                        Forms\Components\Select::make('sex')
                            ->label("Sexo")
                            ->required()
                            ->options([
                                'Masculino' => 'Masculino',
                                'Femenino' => 'Femenino',
                            ]),
                        Forms\Components\Select::make('is_active')
                            ->label("Estado")
                            ->options([
                                '1' => 'Activo',
                                '0' => 'Desativo',
                            ]),
                    ])->columns(2),

                Forms\Components\Section::make('Relação')
                    ->schema([
                        Forms\Components\Select::make('class_id')
                            ->label("Turma")
                            ->options($class)
                            ->required(),
                        Forms\Components\Select::make('incharge_id')
                            ->label("Encarregado")
                            ->options($incharge)
                            ->required(),

                        Forms\Components\Select::make('relationship')
                            ->label('Parentesco')
                            ->options([
                                'Pai' => 'Pai',
                                'Mãe' => 'Mãe',
                                'Avô' => 'Avô',
                                'Tio' => 'Tio',
                                'Tia' => 'Tia',
                                'Padrasto' => 'Padrasto',
                                'Madrasta' => 'Madrasta',
                                'Irmão' => 'Irmão',
                                'Irmã' => 'Irmã',
                                'Outro' => 'Outro',
                            ])
                    ])->columns(3),
                Forms\Components\Section::make('Acesso ao aplicativo')
                    ->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->label("Telefone")
                            ->required()
                            ->maxLength(9)
                            ->tel()
                            ->autocomplete('new-password')
                            ->prefix('+244'),
                        Forms\Components\TextInput::make('password')
                            ->label("Senha")
                    ])->columns(2),
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label("Imagem")
                            ->visibility('public')
                            ->directory('student-images')

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
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label("Email"),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->label("Telefone"),
                Tables\Columns\TextColumn::make('encarregados.name')
                    ->searchable()
                    ->label("Encarregado"),
                Tables\Columns\TextColumn::make('turmas.name')
                    ->searchable()
                    ->label("Turma"),
                Tables\Columns\TextColumn::make('bi')
                    ->searchable()
                    ->label("Número do BI"),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label("Morada"),
                Tables\Columns\ImageColumn::make('photo')
                    ->circular()
                    ->label("Imagem"),
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
                                ->title('Aluno/a Editado.')
                                ->body('O Aluno/a foi editado com sucesso.')
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
                                ->body('Aluno/a  foi Criado com sucesso.')
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
            'index' => Pages\ListAlunos::route('/'),
            'create' => Pages\CreateAlunos::route('/create'),
            'edit' => Pages\EditAlunos::route('/{record}/edit'),
        ];
    }
}
