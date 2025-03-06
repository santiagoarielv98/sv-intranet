<?php

namespace App\Filament\Personal\Resources\AttendanceResource\Actions;

use App\Models\Attendance;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CheckInAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'Check In';
    }

    protected function setUp(): void
    {
        parent::setUp();
        parent::label('Check In')
            ->icon('heroicon-o-play')
            ->requiresConfirmation()
            ->color('success')
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

                Attendance::create([
                    'employee_id' => $employee->id,
                    'check_in' => now(),
                    'ip_address' => request()->ip(),
                ]);

                Notification::make()
                    ->title('Checked In')
                    ->body('You have successfully checked in at ' . now()->format('H:i'))
                    ->success()
                    ->send();
            });
    }
}
