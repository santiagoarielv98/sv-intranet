<?php

namespace App\Filament\Exports;

use App\Models\Timesheet;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class TimesheetExporter extends Exporter
{
    protected static ?string $model = Timesheet::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label(__('filament.common.fields.id')),
            ExportColumn::make('calendar.name')
                ->label(__('filament.common.fields.calendar')),
            ExportColumn::make('user.name')
                ->label(__('filament.common.fields.user')),
            ExportColumn::make('type')
                ->label(__('filament.common.fields.type')),
            ExportColumn::make('day_in')
                ->label(__('filament.common.fields.day_in')),
            ExportColumn::make('day_out')
                ->label(__('filament.common.fields.day_out')),
            ExportColumn::make('created_at')
                ->label(__('filament.common.fields.created_at')),
            ExportColumn::make('updated_at')
                ->label(__('filament.common.fields.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your timesheet export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
