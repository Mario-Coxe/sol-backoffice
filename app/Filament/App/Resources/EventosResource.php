<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\EventosResource\Pages;
use App\Filament\App\Resources\EventosResource\RelationManagers;
use App\Models\Eventos;
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

class EventosResource extends Resource
{
    protected static ?string $model = Eventos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Escola';

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        $currentTeam = $user ? $user->teams->first() : null;


        $academicYear = $currentTeam
            ? $currentTeam->anosLetivos->pluck('name', 'id')->toArray()
            : [];

        return $form

            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('theme')
                                    ->label("Tema")
                                    ->required(),
                                Forms\Components\Select::make('academic_year_id')
                                    ->label("Ano Letivo")
                                    ->options($academicYear)
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
                        Forms\Components\DateTimePicker::make('data_time')
                            ->label("Data e Hora")
                            ->native(true)
                    ])->columns(2),
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label("Imagem")
                            ->visibility('public')
                            ->directory('events-images')

                    ]),

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
                Tables\Columns\TextColumn::make('theme')
                    ->label("Tema")
                    ->searchable(),
                Tables\Columns\TextColumn::make('anosLetivos.name')
                    ->label("Ano Letivo")
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_time')
                    ->label("Data")
                    ->searchable()
                    ->date(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label("Estado")
                    ->boolean(),
                Tables\Columns\ImageColumn::make('photo')
                    ->label("Imagem"),
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
                                ->title('Evento Editado.')
                                ->body('O Evento foi editado com sucesso.')

                        ),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Evento Eliminado.')
                                ->body('O Evento foi excluído com sucesso.')
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
            'index' => Pages\ListEventos::route('/'),
            'create' => Pages\CreateEventos::route('/create'),
            'edit' => Pages\EditEventos::route('/{record}/edit'),
        ];
    }
}
