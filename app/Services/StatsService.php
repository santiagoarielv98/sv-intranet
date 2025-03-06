<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatsService
{
    public function calculateHoursWorkedToday(): string
    {
        if(!auth()->user()->employee) {
            return '0:00';
        }
        $today = Carbon::today();
        $attendances = auth()->user()->employee->attendances()
            ->whereDate('created_at', $today)
            ->get();

        $totalMinutes = 0;

        foreach ($attendances as $attendance) {
            $checkIn = Carbon::parse($attendance->check_in);
            $checkOut = $attendance->check_out ? Carbon::parse($attendance->check_out) : Carbon::now();
            $totalMinutes += $checkIn->diffInMinutes($checkOut);
        }

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%d:%02d', $hours, $minutes);
    }
    
    public function calculateHoursWorkedThisWeek(): string
    {
        if(!auth()->user()->employee) {
            return '0:00';
        }
        
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        $attendances = auth()->user()->employee->attendances()
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->get();

        $totalMinutes = 0;

        foreach ($attendances as $attendance) {
            $checkIn = Carbon::parse($attendance->check_in);
            $checkOut = $attendance->check_out ? Carbon::parse($attendance->check_out) : Carbon::now();
            $totalMinutes += $checkIn->diffInMinutes($checkOut);
        }

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%d:%02d', $hours, $minutes);
    }
    
    public function calculateTotalLeaveDaysTaken(): int
    {
        if(!auth()->user()->employee) {
            return 0;
        }
        
        $approvedLeaves = auth()->user()->employee->leaveRequests()
            ->where('status', 'approved')
            ->whereDate('end_date', '<', Carbon::today())
            ->get();
            
        $totalDays = 0;
        
        foreach ($approvedLeaves as $leave) {
            $startDate = Carbon::parse($leave->start_date);
            $endDate = Carbon::parse($leave->end_date);
            $totalDays += $startDate->diffInDays($endDate) + 1; // +1 to include the end date
        }
        
        return $totalDays;
    }
    
    public function countPendingLeaveRequests(): int
    {
        if(!auth()->user()->employee) {
            return 0;
        }
        
        return auth()->user()->employee->leaveRequests()
            ->where('status', 'pending')
            ->count();
    }
    
    public function calculateUpcomingLeaveDays(): int
    {
        if(!auth()->user()->employee) {
            return 0;
        }
        
        $upcomingLeaves = auth()->user()->employee->leaveRequests()
            ->where('status', 'approved')
            ->where(function($query) {
                $query->whereDate('start_date', '>=', Carbon::today())
                    ->orWhereDate('end_date', '>=', Carbon::today());
            })
            ->get();
            
        $totalDays = 0;
        
        foreach ($upcomingLeaves as $leave) {
            $startDate = Carbon::parse($leave->start_date);
            $endDate = Carbon::parse($leave->end_date);
            
            // Adjust start date if it's in the past
            if ($startDate->lt(Carbon::today())) {
                $startDate = Carbon::today();
            }
            
            $totalDays += $startDate->diffInDays($endDate) + 1; // +1 to include the end date
        }
        
        return $totalDays;
    }
}
