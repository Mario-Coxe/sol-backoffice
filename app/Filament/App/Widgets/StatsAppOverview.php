<?php

namespace App\Filament\App\Widgets;

use App\Models\Alunos;
use App\Models\Cursos;
use App\Models\Department;
use App\Models\Disciplinas;
use App\Models\Employee;
use App\Models\Encarregados;
use App\Models\Professores;
use App\Models\Team;
use App\Models\Turmas;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAppOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            /*
                            Stat::make('Users', Team::find(Filament::getTenant())->first()->members->getStats())
                ->description('All users from the database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            */

            Stat::make('Alunos', Alunos::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('Total de Alunos')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Professores', Professores::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('Total de Professores')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                Stat::make('Encarregados', Encarregados::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('Total de encarregados')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Cursos', Cursos::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('Total de cursos')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Turmas', Turmas::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('Total de turmas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Disciplinas', Disciplinas::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('Total de disciplinas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
