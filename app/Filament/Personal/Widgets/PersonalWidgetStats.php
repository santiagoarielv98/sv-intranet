<?php

namespace App\Filament\Personal\Widgets;

use App\Models\Holiday;
use App\Models\Timesheet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\TimesheetService;
use Illuminate\Support\Facades\Lang;

class PersonalWidgetStats extends BaseWidget
{
    protected function getStats(): array
    {
        $timesheetService = new TimesheetService();
        $status = $timesheetService->getStatus();
        $statusConfig = config('timesheet.status');

        return [
            Stat::make(Lang::get('filament.personal_widget_stats.current_status'), __($statusConfig[$status]['description']))
                ->icon($statusConfig[$status]['icon'])
                ->color($statusConfig[$status]['color']),

            Stat::make(Lang::get('filament.personal_widget_stats.hours_worked_today'), $timesheetService->calculateHoursWorkedToday())
                ->description(Lang::get('filament.personal_widget_stats.total_work_time'))
                ->icon('heroicon-o-clock')
                ->color('success'),

            Stat::make(Lang::get('filament.personal_widget_stats.break_time_today'), $timesheetService->calculateTotalPauseToday())
                ->description(Lang::get('filament.personal_widget_stats.total_break_time'))
                ->icon('heroicon-o-clock')
                ->color($status === 'paused' ? 'warning' : 'info'),

            Stat::make(Lang::get('filament.personal_widget_stats.pending_holidays'), Holiday::where('type', 'pending')
                ->where('user_id', Auth::user()->id)
                ->count())
                ->icon('heroicon-o-calendar')
                ->color('warning'),

            Stat::make(Lang::get('filament.personal_widget_stats.approved_holidays'), Holiday::where('type', 'approved')
                ->where('user_id', Auth::user()->id)
                ->count())
                ->icon('heroicon-o-calendar-days')
                ->color('success'),
        ];
    }
}
