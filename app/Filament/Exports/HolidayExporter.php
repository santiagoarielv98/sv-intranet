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
            ExportColumn::make('id')
                ->label(__('filament.common.fields.id')),
            ExportColumn::make('user.name')
                ->label(__('filament.common.fields.user')),
            ExportColumn::make('day')
                ->label(__('filament.common.fields.day')),
            ExportColumn::make('type')
                ->label(__('filament.common.fields.type')),
            ExportColumn::make('calendar.name')
                ->label(__('filament.common.fields.calendar')),
            ExportColumn::make('calendar.year')
                ->label(__('filament.common.fields.year')),
            ExportColumn::make('created_at')
                ->label(__('filament.common.fields.created_at')),
            ExportColumn::make('updated_at')
                ->label(__('filament.common.fields.updated_at')),
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
}
