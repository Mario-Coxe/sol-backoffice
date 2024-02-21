<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ProfessoresResource\Pages;
use App\Filament\App\Resources\ProfessoresResource\RelationManagers;
use App\Models\Professores;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;


class ProfessoresResource extends Resource
{
    protected static ?string $model = Professores::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationGroup = 'Gestão de Professores';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informaçãoes')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label("Nome")
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label("Email")
                            ->required()
                            ->email(),
                        Forms\Components\TextInput::make('address')
                            ->label("Morada"),
                        Forms\Components\Select::make('sex')
                            ->label("Sexo")
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
                Forms\Components\Section::make('Acesso ao aplicativo')
                    ->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->label("Telefone")
                            ->maxLength(9)
                            ->required()
                            ->tel()
                            ->autocomplete('new-password')
                            ->prefix('+244'),
                        Forms\Components\TextInput::make('password')
                            ->label("Senha")
                            ->required()
                    ])->columns(2),
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label("Imagem")
                            ->visibility('public')
                            ->directory('teachers-images')

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
                Tables\Columns\TextColumn::make('sex')
                    ->searchable()
                    ->label("Sexo"),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label("Morada"),
                Tables\Columns\IconColumn::make('is_active')
                    ->label("Estado")
                    ->boolean(),
                Tables\Columns\ImageColumn::make('photo')
                    ->label("Imagem")
                    ->circular()
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
                                ->title('Professor/a Editado.')
                                ->body('O Professor/a foi editado com sucesso.')
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
                                ->body('Professor/a  foi Criado com sucesso.')
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
            'index' => Pages\ListProfessores::route('/'),
            'create' => Pages\CreateProfessores::route('/create'),
            'edit' => Pages\EditProfessores::route('/{record}/edit'),
        ];
    }
}
