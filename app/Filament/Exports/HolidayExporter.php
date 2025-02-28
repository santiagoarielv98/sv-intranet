<?php

namespace App\Filament\Exports;

use App\Models\Holiday;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class HolidayExporter extends Exporter
{
    protected static ?string $model = Holiday::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('user.name'),
            ExportColumn::make('day'),
            ExportColumn::make('type'),
            ExportColumn::make('calendar.name'),
            ExportColumn::make('calendar.year'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your holiday export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getFileName(Export $export): string
    {
        return 'holidays-' . now()->format('Y-m-d-H-i-s') . '.csv';
    }
}
