<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\EncarregadosResource\Pages;
use App\Filament\App\Resources\EncarregadosResource\RelationManagers;
use App\Models\Encarregados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class EncarregadosResource extends Resource
{
    protected static ?string $model = Encarregados::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestão de Alunos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informaçãoes')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label("Nome"),
                        Forms\Components\TextInput::make('email')
                            ->label("Email")
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
                            ->directory('incharges-images')

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
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->label("Telefone"),
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
                                ->title('Encarregado/a Editado.')
                                ->body('O Encarregado/a foi editado com sucesso.')
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
                                ->body('Encarregado/a  foi Criado com sucesso.')
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
            'index' => Pages\ListEncarregados::route('/'),
            'create' => Pages\CreateEncarregados::route('/create'),
            'edit' => Pages\EditEncarregados::route('/{record}/edit'),
        ];
    }
}
