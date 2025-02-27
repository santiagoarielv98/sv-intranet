<?php

namespace App\Filament\Widgets;

use App\Models\Holiday;
use App\Models\Timesheet;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Lang;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {   
        $totalEmployees = User::all()->count();
        $totalHolidays = Holiday::all()->count();
        $totalTimesheets = Timesheet::all()->count();

        return [
            Stat::make(Lang::get('filament.stats_overview.employees'), $totalEmployees)
                ->icon('heroicon-o-users')
                ->color('purple'),

            Stat::make(Lang::get('filament.stats_overview.holidays'), $totalHolidays)
                ->icon('heroicon-o-calendar')
                ->color('blue'),

            Stat::make(Lang::get('filament.stats_overview.timesheets'), $totalTimesheets)
                ->icon('heroicon-o-table-cells')
                ->color('green'), 
        ];
    }
}
