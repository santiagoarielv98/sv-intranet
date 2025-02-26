<?php

namespace App\Services;

use App\Models\Timesheet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimesheetService
{
    public function startWork(): void
    {
        Timesheet::create([
            'user_id' => Auth::user()->id,
            'calendar_id' => 1,
            'type' => 'work',
            'day_in' => now(),
        ]);
    }

    public function pauseWork(): void
    {
        $activeTimesheet = $this->getActiveTimesheet();
        if ($activeTimesheet) {
            $activeTimesheet->update(['day_out' => now()]);
            
            // Crear registro de pausa
            Timesheet::create([
                'user_id' => Auth::user()->id,
                'calendar_id' => 1,
                'type' => 'pause',
                'day_in' => now(),
            ]);
        }
    }

    public function resumeWork(): void
    {
        $activePause = $this->getActivePause();
        if ($activePause) {
            $activePause->update(['day_out' => now()]);
            
            // Crear nuevo registro de trabajo
            Timesheet::create([
                'user_id' => Auth::user()->id,
                'calendar_id' => 1,
                'type' => 'work',
                'day_in' => now(),
            ]);
        }
    }

    public function getActiveTimesheet(): ?Timesheet
    {
        return Timesheet::where('user_id', Auth::user()->id)
            ->whereNull('day_out')
            ->where('type', 'work')
            ->first();
    }

    public function getActivePause(): ?Timesheet
    {
        return Timesheet::where('user_id', Auth::user()->id)
            ->whereNull('day_out')
            ->where('type', 'pause')
            ->first();
    }

    public function calculateHoursWorkedToday(): string
    {
        $today = Carbon::today();
        $timesheets = Timesheet::where('user_id', Auth::user()->id)
            ->whereDate('day_in', $today)
            ->where('type', 'work')
            ->get();

        $totalMinutes = 0;

        foreach ($timesheets as $timesheet) {
            $dayIn = Carbon::parse($timesheet->day_in);
            $dayOut = $timesheet->day_out ? Carbon::parse($timesheet->day_out) : Carbon::now();
            $totalMinutes += $dayIn->diffInMinutes($dayOut);
        }

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%d:%02d', $hours, $minutes);
    }

    public function calculateTotalPauseToday(): string
    {
        $today = Carbon::today();
        $pauses = Timesheet::where('user_id', Auth::user()->id)
            ->whereDate('day_in', $today)
            ->where('type', 'pause')
            ->get();

        $totalMinutes = 0;

        foreach ($pauses as $pause) {
            $dayIn = Carbon::parse($pause->day_in);
            $dayOut = $pause->day_out ? Carbon::parse($pause->day_out) : Carbon::now();
            $totalMinutes += $dayIn->diffInMinutes($dayOut);
        }

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%d:%02d', $hours, $minutes);
    }
}
