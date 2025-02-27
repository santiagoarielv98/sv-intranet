<?php

namespace App\Filament\Exports;

use App\Models\Department;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DepartmentExporter extends Exporter
{
    protected static ?string $model = Department::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label(__('filament.common.fields.id')),
            ExportColumn::make('name')
                ->label(__('filament.common.fields.name')),
            ExportColumn::make('users_count')
                ->label(__('filament.common.fields.users_count'))
                ->counts('users'),
            ExportColumn::make('created_at')
                ->label(__('filament.common.fields.created_at')),
            ExportColumn::make('updated_at')
                ->label(__('filament.common.fields.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your department export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getFileName(Export $export): string
    {
        return 'departments-' . now()->format('Y-m-d-H-i-s') . '.csv';
    }
}
