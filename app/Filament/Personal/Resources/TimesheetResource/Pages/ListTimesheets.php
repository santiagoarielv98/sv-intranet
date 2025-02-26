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
                ->label(__($config['start']['label']))
                ->visible($timesheetService->canStartWork())
                ->requiresConfirmation()
                ->modalHeading(__($config['start']['heading']))
                ->modalDescription(__($config['start']['description']))
                ->icon('heroicon-o-play')
                ->color('success')
                ->action(fn() => $timesheetService->startWork()),

            Actions\Action::make('pauseWork')
                ->label(__($config['pause']['label']))
                ->visible($timesheetService->canPause())
                ->requiresConfirmation()
                ->modalHeading(__($config['pause']['heading']))
                ->modalDescription(__($config['pause']['description']))
                ->icon('heroicon-o-pause')
                ->color('warning')
                ->action(fn() => $timesheetService->pauseWork()),

            Actions\Action::make('resumeWork')
                ->label(__($config['resume']['label']))
                ->visible($timesheetService->canResume())
                ->requiresConfirmation()
                ->modalHeading(__($config['resume']['heading']))
                ->modalDescription(__($config['resume']['description']))
                ->icon('heroicon-o-play')
                ->color('success')
                ->action(fn() => $timesheetService->resumeWork()),

            Actions\Action::make('stopWork')
                ->label(__($config['stop']['label']))
                ->visible($timesheetService->canStop())
                ->requiresConfirmation()
                ->modalHeading(__($config['stop']['heading']))
                ->modalDescription(__($config['stop']['description']))
                ->icon('heroicon-o-stop')
                ->color('danger')
                ->action(fn() => $timesheetService->stopWork()),

            Actions\CreateAction::make(),
        ];
    }
}
