<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $statsService = app(\App\Services\AdminStatsService::class);

        $todayAttendancePercentage = $statsService->getTodayAttendancePercentage();
        $todayAttendanceColor = $todayAttendancePercentage < 50 ? 'danger' : ($todayAttendancePercentage < 75 ? 'warning' : 'success');

        $weeklyAverageAttendance = $statsService->getWeeklyAverageAttendance();
        $weeklyAverageAttendanceColor = $weeklyAverageAttendance < 50 ? 'danger' : ($weeklyAverageAttendance < 75 ? 'warning' : 'success');

        return [
            Stat::make('Total Employees', $statsService->getTotalEmployees())
                ->description('Active employees')
                ->descriptionIcon('heroicon-m-user')
                ->color('success'),

            Stat::make('New Hires', $statsService->getNewEmployeesThisMonth())
                ->description('This month')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('info'),

            Stat::make('Registered Users', $statsService->getTotalUsers())
                ->description('Total user accounts')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),

            Stat::make('Pending Leave Requests', $statsService->getPendingLeaveRequests())
                ->description('Awaiting approval')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('danger'),

            Stat::make('Approved Leaves', $statsService->getApprovedLeavesThisMonth())
                ->description('This month')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
            Stat::make('Today\'s Attendance', $todayAttendancePercentage . '%')
                ->description('Employees present today')
                ->descriptionIcon('heroicon-m-finger-print')
                ->chart([65, 62, 68, 75, 71, 69, 72, $todayAttendancePercentage])
                ->color($todayAttendanceColor),
            Stat::make('Weekly Avg. Attendance', $weeklyAverageAttendance . '%')
                ->description('This week')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($weeklyAverageAttendanceColor),

        ];
    }
}
