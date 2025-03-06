<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;

class AdminStatsService
{
    /**
     * Get the total number of employees
     *
     * @return int
     */
    public function getTotalEmployees(): int
    {
        return Employee::where('status', 'active')->count();
    }
    
    /**
     * Get the number of new employees hired in the current month
     *
     * @return int
     */
    public function getNewEmployeesThisMonth(): int
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        return Employee::whereBetween('hire_date', [$startOfMonth, $endOfMonth])->count();
    }
    
    /**
     * Get the total number of registered users
     *
     * @return int
     */
    public function getTotalUsers(): int
    {
        return User::count();
    }
    
    /**
     * Get the number of pending leave requests
     *
     * @return int
     */
    public function getPendingLeaveRequests(): int
    {
        return LeaveRequest::where('status', 'pending')->count();
    }
    
    /**
     * Get the approved leave requests for the current month
     *
     * @return int
     */
    public function getApprovedLeavesThisMonth(): int
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        return LeaveRequest::where('status', 'approved')
            ->where(function($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                    ->orWhereBetween('end_date', [$startOfMonth, $endOfMonth]);
            })
            ->count();
    }
    
    /**
     * Get the attendance percentage for today
     *
     * @return float
     */
    public function getTodayAttendancePercentage(): float
    {
        $today = Carbon::today();
        $activeEmployees = Employee::where('status', 'active')->count();
        
        if ($activeEmployees === 0) {
            return 0;
        }
        
        $employeesPresent = Attendance::whereDate('check_in', $today)
            ->distinct('employee_id')
            ->count('employee_id');
            
        return round(($employeesPresent / $activeEmployees) * 100, 1);
    }
    
    /**
     * Get the average daily attendance for the current week
     *
     * @return float
     */
    public function getWeeklyAverageAttendance(): float
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $today = Carbon::today();
        $activeEmployees = Employee::where('status', 'active')->count();
        
        if ($activeEmployees === 0) {
            return 0;
        }
        
        $daysPassed = $startOfWeek->diffInDays($today) + 1; // +1 to include today
        
        $totalAttendances = 0;
        $currentDay = clone $startOfWeek;
        
        for ($i = 0; $i < $daysPassed; $i++) {
            $attendances = Attendance::whereDate('check_in', $currentDay)
                ->distinct('employee_id')
                ->count('employee_id');
                
            $totalAttendances += $attendances;
            $currentDay->addDay();
        }
        
        if ($daysPassed === 0) {
            return 0;
        }
        
        $averageAttendance = $totalAttendances / $daysPassed;
        $percentage = ($averageAttendance / $activeEmployees) * 100;
        
        return round($percentage, 1);
    }
}
