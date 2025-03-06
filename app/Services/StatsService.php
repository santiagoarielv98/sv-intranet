<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class StatsService
{
    /**
     * Calculate the hours worked by the authenticated user today
     *
     * @return string Hours in format "H:MM"
     */
    public function calculateHoursWorkedToday(): string
    {
        if (!$this->hasEmployee()) {
            return '0:00';
        }
        
        $today = Carbon::today();
        $attendances = $this->getEmployeeAttendances($today, $today);

        return $this->calculateHoursWorked($attendances);
    }
    
    /**
     * Calculate the hours worked by the authenticated user this week
     *
     * @return string Hours in format "H:MM"
     */
    public function calculateHoursWorkedThisWeek(): string
    {
        if (!$this->hasEmployee()) {
            return '0:00';
        }
        
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        $attendances = $this->getEmployeeAttendances($startOfWeek, $endOfWeek);

        return $this->calculateHoursWorked($attendances);
    }
    
    /**
     * Calculate total approved leave days already taken
     *
     * @return int Number of days
     */
    public function calculateTotalLeaveDaysTaken(): int
    {
        if (!$this->hasEmployee()) {
            return 0;
        }
        
        $approvedLeaves = auth()->user()->employee->leaveRequests()
            ->where('status', 'approved')
            ->whereDate('end_date', '<', Carbon::today())
            ->get();
            
        return $this->calculateTotalDaysFromLeaveRequests($approvedLeaves);
    }
    
    /**
     * Count pending leave requests for the authenticated user
     *
     * @return int Number of pending requests
     */
    public function countPendingLeaveRequests(): int
    {
        if (!$this->hasEmployee()) {
            return 0;
        }
        
        return auth()->user()->employee->leaveRequests()
            ->where('status', 'pending')
            ->count();
    }
    
    /**
     * Calculate upcoming approved leave days
     *
     * @return int Number of upcoming leave days
     */
    public function calculateUpcomingLeaveDays(): int
    {
        if (!$this->hasEmployee()) {
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
            
            $totalDays += $this->calculateDaysBetween($startDate, $endDate);
        }
        
        return $totalDays;
    }

    /**
     * Check if the authenticated user has an associated employee
     *
     * @return bool
     */
    private function hasEmployee(): bool
    {
        return auth()->user() && auth()->user()->employee;
    }

    /**
     * Get employee attendances within a date range
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return Collection
     */
    private function getEmployeeAttendances(Carbon $startDate, Carbon $endDate): Collection
    {
        return auth()->user()->employee->attendances()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
    }

    /**
     * Calculate total hours worked from a collection of attendances
     *
     * @param Collection $attendances
     * @return string Hours in format "H:MM"
     */
    private function calculateHoursWorked(Collection $attendances): string
    {
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
    
    /**
     * Calculate the total number of days from a collection of leave requests
     *
     * @param Collection $leaveRequests
     * @return int
     */
    private function calculateTotalDaysFromLeaveRequests(Collection $leaveRequests): int
    {
        $totalDays = 0;
        
        foreach ($leaveRequests as $leave) {
            $startDate = Carbon::parse($leave->start_date);
            $endDate = Carbon::parse($leave->end_date);
            $totalDays += $this->calculateDaysBetween($startDate, $endDate);
        }
        
        return $totalDays;
    }
    
    /**
     * Calculate number of days between two dates, inclusive
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return int Number of days
     */
    private function calculateDaysBetween(Carbon $startDate, Carbon $endDate): int
    {
        return $startDate->diffInDays($endDate) + 1; // +1 to include the end date
    }
}
