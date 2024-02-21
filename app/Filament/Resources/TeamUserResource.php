<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamUserResource\Pages;
use App\Filament\Resources\TeamUserResource\RelationManagers;
use App\Models\TeamUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use App\Models\Team;
use App\Models\User;

class TeamUserResource extends Resource
{
    protected static ?string $model = TeamUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        $team = Team::pluck('name', 'id')->toArray();
        $user = User::pluck('name', 'id')->toArray();


        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label("Usuário")
                                    ->options($user)
                                    ->required(),
                                Forms\Components\Select::make('team_id')
                                    ->label("Agencia")
                                    ->options($team)
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label("Gestor")
                    ->searchable(),
                TextColumn::make('team.name')
                    ->label("Agência")
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTeamUsers::route('/'),
            'create' => Pages\CreateTeamUser::route('/create'),
            'edit' => Pages\EditTeamUser::route('/{record}/edit'),
        ];
    }
}