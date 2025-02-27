<?php

namespace App\Services;

use App\Models\Timesheet;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimesheetService
{
    public function canStartWork(): bool
    {
        return !$this->getActiveTimesheet() && !$this->getActivePause();
    }

    public function canPause(): bool
    {
        return $this->getActiveTimesheet() !== null && !$this->getActivePause();
    }

    public function canResume(): bool
    {
        return $this->getActivePause() !== null;
    }

    public function canStop(): bool
    {
        return $this->getActiveTimesheet() !== null;
    }

    public function getActiveCalendar(): ?Calendar
    {
        return Calendar::where('active', true)->orderBy('created_at', 'desc')->first();
    }

    public function startWork(): void
    {
        if ($this->canStartWork()) {
            Timesheet::create([
                'user_id' => Auth::user()->id,
                'calendar_id' => $this->getActiveCalendar()->id,
                'type' => 'work',
                'day_in' => now(),
            ]);
        }
    }

    public function pauseWork(): void
    {
        if ($this->canPause()) {
            $activeTimesheet = $this->getActiveTimesheet();
            $activeTimesheet->update(['day_out' => now()]);
            
            Timesheet::create([
                'user_id' => Auth::user()->id,
                'calendar_id' => $this->getActiveCalendar()->id,
                'type' => 'pause',
                'day_in' => now(),
            ]);
        }
    }

    public function resumeWork(): void
    {
        if ($this->canResume()) {
            $activePause = $this->getActivePause();
            $activePause->update(['day_out' => now()]);
            
            Timesheet::create([
                'user_id' => Auth::user()->id,
                'calendar_id' => $this->getActiveCalendar()->id,
                'type' => 'work',
                'day_in' => now(),
            ]);
        }
    }

    public function stopWork(): void
    {
        $activeTimesheet = $this->getActiveTimesheet();
        if ($activeTimesheet) {
            $activeTimesheet->update(['day_out' => now()]);
        }

        // Si hay una pausa activa, también la detenemos
        $activePause = $this->getActivePause();
        if ($activePause) {
            $activePause->update(['day_out' => now()]);
        }
    }

    public function getStatus(): string
    {
        if ($this->getActiveTimesheet()) {
            return 'working';
        }
        if ($this->getActivePause()) {
            return 'paused';
        }
        return 'stopped';
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
