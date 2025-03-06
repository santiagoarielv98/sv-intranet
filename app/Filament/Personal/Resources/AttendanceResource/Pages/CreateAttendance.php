<?php

namespace App\Filament\Personal\Resources\AttendanceResource\Pages;

use App\Filament\Personal\Resources\AttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttendance extends CreateRecord
{
    protected static string $resource = AttendanceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['employee_id'] = auth()->user()->employee->id ?? -1;

        return $data;
    }
}
