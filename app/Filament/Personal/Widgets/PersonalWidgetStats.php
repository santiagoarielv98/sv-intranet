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
        $totalPendingHolidays = Holiday::where('type', 'pending')
            ->where('user_id', Auth::user()->id)
            ->count();
        $totalApprovedHolidays = Holiday::where('type', 'approved')
            ->where('user_id', Auth::user()->id)
            ->count();

        $timesheetService = new TimesheetService();
        $hoursWorkedToday = $timesheetService->calculateHoursWorkedToday();
        $pauseTimeToday = $timesheetService->calculateTotalPauseToday();
        
        $activeTimesheet = $timesheetService->getActiveTimesheet();
        $activePause = $timesheetService->getActivePause();

        return [
            Stat::make('Total Pending Holidays', $totalPendingHolidays)
                ->icon('heroicon-o-clock'),
            Stat::make('Total Approved Holidays', $totalApprovedHolidays)
                ->icon('heroicon-o-clock'),
            Stat::make('Hours Worked Today', $hoursWorkedToday)
                ->description($activeTimesheet ? 'Currently working' : ($activePause ? 'On break' : 'Not working'))
                ->descriptionIcon($activeTimesheet ? 'heroicon-o-play' : ($activePause ? 'heroicon-o-pause' : 'heroicon-o-stop'))
                ->color($activeTimesheet ? 'success' : ($activePause ? 'warning' : 'danger')),
            Stat::make('Total Pause Time', $pauseTimeToday)
                ->description($activePause ? 'Currently on break' : 'Total pauses today')
                ->descriptionIcon('heroicon-o-clock')
                ->color($activePause ? 'warning' : 'info'),
        ];
    }
}
