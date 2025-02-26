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
        $config = config('timesheet.actions');

        return [
            Actions\Action::make('startWork')
                ->label($config['start']['label'])
                ->visible($timesheetService->canStartWork())
                ->requiresConfirmation()
                ->modalHeading($config['start']['heading'])
                ->modalDescription($config['start']['description'])
                ->icon('heroicon-o-play')
                ->color('success')
                ->action(fn() => $timesheetService->startWork()),

            Actions\Action::make('pauseWork')
                ->label($config['pause']['label'])
                ->visible($timesheetService->canPause())
                ->requiresConfirmation()
                ->modalHeading($config['pause']['heading'])
                ->modalDescription($config['pause']['description'])
                ->icon('heroicon-o-pause')
                ->color('warning')
                ->action(fn() => $timesheetService->pauseWork()),

            Actions\Action::make('resumeWork')
                ->label($config['resume']['label'])
                ->visible($timesheetService->canResume())
                ->requiresConfirmation()
                ->modalHeading($config['resume']['heading'])
                ->modalDescription($config['resume']['description'])
                ->icon('heroicon-o-play')
                ->color('success')
                ->action(fn() => $timesheetService->resumeWork()),

            Actions\Action::make('stopWork')
                ->label($config['stop']['label'])
                ->visible($timesheetService->canStop())
                ->requiresConfirmation()
                ->modalHeading($config['stop']['heading'])
                ->modalDescription($config['stop']['description'])
                ->icon('heroicon-o-stop')
                ->color('danger')
                ->action(fn() => $timesheetService->stopWork()),

            Actions\CreateAction::make(),
        ];
    }
}
