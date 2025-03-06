<?php

namespace App\Filament\Personal\Resources\AttendanceResource\Pages;

use App\Filament\Personal\Resources\AttendanceResource;
use App\Filament\Personal\Resources\AttendanceResource\Actions\CheckInAction;
use App\Filament\Personal\Resources\AttendanceResource\Actions\CheckOutAction;
use App\Models\Attendance;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        $employee = Auth::user()->employee;
        $hasActiveCheckIn = false;

        if ($employee) {
            $hasActiveCheckIn = Attendance::where('employee_id', $employee->id)
                ->whereNull('check_out')
                ->exists();
        }

        return [
            Actions\CreateAction::make(),
            CheckInAction::make()->visible(!$hasActiveCheckIn),
            CheckOutAction::make()->visible($hasActiveCheckIn),
        ];
    }
}
