<?php

namespace App\Observers;

use App\Models\Holiday;
use App\Models\User;
use Filament\Notifications\Notification;

class HolidayObserver
{
    /**
     * Handle the Holiday "created" event.
     */
    public function created(Holiday $holiday): void
    {
        if ($this->isPendingAndNotSuperAdmin($holiday)) {
            $this->notifyAdmins($holiday);
        }
    }

    /**
     * Handle the Holiday "updated" event.
     */
    public function updated(Holiday $holiday): void
    {
        if ($this->isPendingAndNotSuperAdmin($holiday)) {
            $this->notifyAdmins($holiday);
        } elseif ($holiday->isDirty('type') && $holiday->type === 'approved') {
            Notification::make()
                ->success()
                ->title('filament.notifications.holiday.approved.title')
                ->body('filament.notifications.holiday.approved.body')
                ->sendToDatabase($holiday->user);
        } elseif ($holiday->isDirty('type') && $holiday->type === 'decline') {
            Notification::make()
                ->danger()
                ->title('filament.notifications.holiday.decline.title')
                ->body('filament.notifications.holiday.decline.body')
                ->sendToDatabase($holiday->user);
        }
    }

    /**
     * Handle the Holiday "deleted" event.  
     */
    public function deleted(Holiday $holiday): void
    {
        //
    }

    /**
     * Handle the Holiday "restored" event.
     */
    public function restored(Holiday $holiday): void
    {
        //
    }

    /**
     * Handle the Holiday "force deleted" event.
     */
    public function forceDeleted(Holiday $holiday): void
    {
        //
    }

    public function isPendingAndNotSuperAdmin(Holiday $holiday): bool
    {
        return $holiday->type === 'pending' && auth()->user()->role !== 'super_admin';
    }

    public function notifyAdmins(Holiday $holiday): void
    {
        Notification::make()
            ->info()
            ->title('filament.notifications.holiday.requested.title')
            ->body($holiday->user->name)
            ->sendToDatabase(User::role('super_admin')->get());
    }
}
