<?php

namespace App\Filament\Personal\Resources\LeaveRequestResource\Pages;

use App\Filament\Personal\Resources\LeaveRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLeaveRequest extends CreateRecord
{
    protected static string $resource = LeaveRequestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['employee_id'] = auth()->user()->employee->id ?? -1;

        return $data;
    }
}
