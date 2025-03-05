<?php

namespace App\Filament\Exports;

use App\Models\Employee;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class EmployeeExporter extends Exporter
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('full_name')
                ->label('Name'),
            ExportColumn::make('email'),
            ExportColumn::make('phone')
                ->enabledByDefault(false),
            ExportColumn::make('address')
                ->enabledByDefault(false),
            ExportColumn::make('postal_code')
                ->enabledByDefault(false),
            ExportColumn::make('country.name'),
            ExportColumn::make('state.name'),
            ExportColumn::make('city.name'),
            ExportColumn::make('hire_date'),
            ExportColumn::make('position.title'),
            ExportColumn::make('salary')
            ->enabledByDefault(false),
            ExportColumn::make('formatted_salary')
                ->enabledByDefault(false),
            ExportColumn::make('status'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your employee export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
