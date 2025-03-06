<?php

namespace App\Observers;

use App\Models\LeaveRequest;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class LeaveRequestObserver
{
    /**
     * Handle the LeaveRequest "created" event.
     */
    public function created(LeaveRequest $leaveRequest): void
    {
        Log::info('This is an informational message.');

        if (auth()->user()->hasRole('super_admin')) {
            return;
        }

        $recipients = User::role('super_admin')->get();

        Notification::make()
            ->title('New Leave Request')
            ->body('A new leave request has been submitted.')
            ->sendToDatabase($recipients);
    }

    /**
     * Handle the LeaveRequest "updated" event.
     */
    public function updated(LeaveRequest $leaveRequest): void
    {
        if ($leaveRequest->employee->user) {
            if ($leaveRequest->status == 'approved') {
                Notification::make()
                    ->title('Leave Request Approved')
                    ->body('Your leave request has been approved.')
                    ->sendToDatabase($leaveRequest->employee->user);
            } elseif ($leaveRequest->status == 'rejected') {
                Notification::make()
                    ->title('Leave Request Rejected')
                    ->body('Your leave request has been rejected.')
                    ->sendToDatabase($leaveRequest->employee->user);
            }
        } else {
            // TODO: Send an email to the employee
        }
    }

    /**
     * Handle the LeaveRequest "deleted" event.
     */
    public function deleted(LeaveRequest $leaveRequest): void
    {
        //
    }

    /**
     * Handle the LeaveRequest "restored" event.
     */
    public function restored(LeaveRequest $leaveRequest): void
    {
        //
    }

    /**
     * Handle the LeaveRequest "force deleted" event.
     */
    public function forceDeleted(LeaveRequest $leaveRequest): void
    {
        //
    }
}
