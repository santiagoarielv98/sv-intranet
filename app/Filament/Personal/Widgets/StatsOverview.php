<?php

namespace App\Filament\Personal\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = [];

        $statsService = app(\App\Services\StatsService::class);

        if (auth()->user()->employee) {
            $stats[] = Stat::make('Hours Worked Today', $statsService->calculateHoursWorkedToday())
                ->icon('heroicon-o-clock');
                
            $stats[] = Stat::make('Hours Worked This Week', $statsService->calculateHoursWorkedThisWeek())
                ->icon('heroicon-o-calendar');
                
            $stats[] = Stat::make('Leave Days Taken', $statsService->calculateTotalLeaveDaysTaken())
                ->icon('heroicon-o-calendar-days');
                
            $stats[] = Stat::make('Pending Leave Requests', $statsService->countPendingLeaveRequests())
                ->icon('heroicon-o-document-text');
                
            $stats[] = Stat::make('Upcoming Leave Days', $statsService->calculateUpcomingLeaveDays())
                ->icon('heroicon-o-calendar-days');
        }

        return $stats;
    }
}
