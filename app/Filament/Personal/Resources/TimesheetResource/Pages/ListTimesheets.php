<?php

namespace App\Filament\Personal\Resources\TimesheetResource\Pages;

use App\Filament\Personal\Resources\TimesheetResource;
use App\Models\Timesheet;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ListTimesheets extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        $activeTimesheet = Timesheet::where('user_id', Auth::user()->id)
            ->whereNull('day_out')
            ->where('type', 'work')
            ->first();

        $isWorking = $activeTimesheet ? true : false;

        return [
            Actions\Action::make('startWork')
                ->label('Iniciar trabajo')
                ->visible(!$isWorking)
                ->disabled($isWorking)
                ->requiresConfirmation()
                ->icon('heroicon-o-play')
                ->action(function () {
                    Timesheet::create([
                        'user_id' => Auth::user()->id,
                        'calendar_id' => 1,
                        'type' => 'work',
                        'day_in' => now(),
                    ]);
                }),
            Actions\Action::make('pauseWork')
                ->label('Pausar trabajo')
                ->visible($isWorking)
                ->disabled(!$isWorking)
                ->requiresConfirmation()
                ->icon('heroicon-o-pause')
                ->color('warning')
                ->action(function () use ($activeTimesheet) {
                    if ($activeTimesheet) {
                        $activeTimesheet->update([
                            'day_out' => now(),
                        ]);
                    }
                }),
            Actions\CreateAction::make(),
        ];
    }
}
