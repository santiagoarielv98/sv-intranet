<?php

namespace App\Filament\Widgets;

use App\Models\Holiday;
use App\Models\Timesheet;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {   
        $totalEmployees = User::all()->count();
        $totalHolidays = Holiday::all()->count();
        $totalTimesheets = Timesheet::all()->count();

        return [
            Stat::make('Employees', $totalEmployees)
                ->icon('heroicon-o-users')
                ->color('purple'),

            Stat::make('Holidays', $totalHolidays)
                ->icon('heroicon-o-calendar')
                ->color('blue'),

            Stat::make('Timesheets', $totalTimesheets)
                ->icon('heroicon-o-table-cells')
                ->color('green'), 
        ];
    }
}
