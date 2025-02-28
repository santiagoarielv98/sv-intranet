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
            ExportColumn::make('id'),
            ExportColumn::make('calendar.name'),
            ExportColumn::make('user.name'),
            ExportColumn::make('type'),
            ExportColumn::make('day_in'),
            ExportColumn::make('day_out'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
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

    public function getFileName(Export $export): string
    {
        return 'timesheets-' . now()->format('Y-m-d-H-i-s') . '.csv';
    }
}
