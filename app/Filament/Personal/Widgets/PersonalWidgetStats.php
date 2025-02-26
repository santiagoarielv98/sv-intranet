<?php

namespace App\Filament\Personal\Widgets;

use App\Models\Holiday;
use App\Models\Timesheet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        $hoursWorkedToday = $this->calculateHoursWorkedToday();
        
        return [
            Stat::make('Total Pending Holidays', $totalPendingHolidays)
                ->icon('heroicon-o-clock'),
            Stat::make('Total Approved Holidays', $totalApprovedHolidays)
                ->icon('heroicon-o-clock'),
            Stat::make('Hours Worked Today', $hoursWorkedToday)
                ->icon('heroicon-o-clock'),
        ];
    }

    private function calculateHoursWorkedToday(): string
    {
        $today = Carbon::today();
        $timesheet = Timesheet::where('user_id', Auth::user()->id)
            ->whereDate('day_in', $today)
            ->where('type', 'work')
            ->first();

        if (!$timesheet) {
            return '0:00';
        }

        $dayIn = Carbon::parse($timesheet->day_in);
        $dayOut = $timesheet->day_out ? Carbon::parse($timesheet->day_out) : Carbon::now();
        
        $diffInMinutes = $dayIn->diffInMinutes($dayOut);
        $hours = floor($diffInMinutes / 60);
        $minutes = $diffInMinutes % 60;

        return sprintf('%d:%02d', $hours, $minutes);
    }
}
