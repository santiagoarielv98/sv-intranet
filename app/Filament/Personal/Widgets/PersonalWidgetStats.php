<?php

namespace App\Filament\Personal\Widgets;

use App\Models\Holiday;
use App\Models\Timesheet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\TimesheetService;

class PersonalWidgetStats extends BaseWidget
{
    protected function getStats(): array
    {
        $timesheetService = new TimesheetService();
        $status = $timesheetService->getStatus();
        $statusConfig = config('timesheet.status');

        return [
            Stat::make('Current Status', $statusConfig[$status]['description'])
                ->icon($statusConfig[$status]['icon'])
                ->color($statusConfig[$status]['color']),

            Stat::make('Hours Worked Today', $timesheetService->calculateHoursWorkedToday())
                ->description('Total work time')
                ->icon('heroicon-o-clock')
                ->color('success'),

            Stat::make('Break Time Today', $timesheetService->calculateTotalPauseToday())
                ->description('Total break time')
                ->icon('heroicon-o-clock')
                ->color($status === 'paused' ? 'warning' : 'info'),

            Stat::make('Pending Holidays', Holiday::where('type', 'pending')
                ->where('user_id', Auth::user()->id)
                ->count())
                ->icon('heroicon-o-calendar')
                ->color('warning'),

            Stat::make('Approved Holidays', Holiday::where('type', 'approved')
                ->where('user_id', Auth::user()->id)
                ->count())
                ->icon('heroicon-o-calendar-days')
                ->color('success'),
        ];
    }
}
