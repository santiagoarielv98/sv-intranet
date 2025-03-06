<?php

namespace App\Filament\Personal\Resources\AttendanceResource\Actions;

use App\Models\Attendance;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CheckOutAction extends Action
{

    public static function getDefaultName(): ?string
    {
        return 'Check Out';
    }

    protected function setUp(): void
    {
        parent::setUp();

        parent::label('Check Out')
            ->icon('heroicon-o-stop')
            ->requiresConfirmation()
            ->color('danger')
            ->action(function () {
                $employee = Auth::user()->employee;

                if (!$employee) {
                    Notification::make()
                        ->title('Error')
                        ->body('You are not registered as an employee.')
                        ->danger()
                        ->send();
                    return;
                }

                $activeAttendance = Attendance::where('employee_id', $employee->id)
                    ->whereNull('check_out')
                    ->latest('check_in')
                    ->first();

                if (!$activeAttendance) {
                    Notification::make()
                        ->title('Error')
                        ->body('You have not checked in yet.')
                        ->danger()
                        ->send();
                    return;
                }

                $activeAttendance->update([
                    'check_out' => now(),
                    'ip_address' => request()->ip(),
                ]);

                Notification::make()
                    ->title('Checked Out')
                    ->body('You have successfully checked out at ' . now()->format('H:i'))
                    ->success()
                    ->send();
            });
    }
}
