<?php

namespace App\Filament\Personal\Resources\TimesheetResource\Pages;

use App\Filament\Personal\Resources\TimesheetResource;
use App\Services\TimesheetService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimesheets extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        $timesheetService = new TimesheetService();
        $activeTimesheet = $timesheetService->getActiveTimesheet();
        $activePause = $timesheetService->getActivePause();

        return [
            Actions\Action::make('startWork')
                ->label('Iniciar trabajo')
                ->visible(!$activeTimesheet && !$activePause)
                ->requiresConfirmation()
                ->icon('heroicon-o-play')
                ->action(fn () => $timesheetService->startWork()),

            Actions\Action::make('pauseWork')
                ->label('Pausar trabajo')
                ->visible($activeTimesheet && !$activePause)
                ->requiresConfirmation()
                ->icon('heroicon-o-pause')
                ->color('warning')
                ->action(fn () => $timesheetService->pauseWork()),

            Actions\Action::make('resumeWork')
                ->label('Reanudar trabajo')
                ->visible(!$activeTimesheet && $activePause)
                ->requiresConfirmation()
                ->icon('heroicon-o-play')
                ->color('success')
                ->action(fn () => $timesheetService->resumeWork()),

            Actions\CreateAction::make(),
        ];
    }
}
