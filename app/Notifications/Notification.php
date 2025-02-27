<?php

namespace App\Notifications;

use Filament\Notifications\Notification as BaseNotification;

class Notification extends BaseNotification
{
    public function toArray(): array
    {
        return [
            ...parent::toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        // dd(__($data['title']));
        $title = __($data['title']);
        if($data['title'] == 'filament.notifications.holiday.requested.title'){
            $body = __('filament.notifications.holiday.requested.body', ['name' => $data['body']]);
        }else{
            $body = __($data['body']);
        }
        return parent::fromArray($data)
            ->title($title)
            ->body($body);
    }
}
