<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label(__('filament.common.fields.id')),
            ExportColumn::make('name')
                ->label(__('filament.common.fields.name')),
            ExportColumn::make('email')
                ->label(__('filament.common.fields.email')),
            // ExportColumn::make('address')
            //     ->label(__('filament.common.fields.address')),
            // ExportColumn::make('departments.name')
            //     ->label(__('filament.common.fields.departments')),
            // ExportColumn::make('postal_code')
            //     ->label(__('filament.common.fields.postal_code')),
            // ExportColumn::make('country.name')
            //     ->label(__('filament.common.fields.country')),
            // ExportColumn::make('state.name')
            //     ->label(__('filament.common.fields.state')),
            // ExportColumn::make('city.name')
            // ->label(__('filament.common.fields.city')),
            ExportColumn::make('created_at')
                ->label(__('filament.common.fields.created_at')),
            ExportColumn::make('updated_at')
                ->label(__('filament.common.fields.updated_at')),
        ];
    }

    public function getFileName(Export $export): string
    {
        return 'users-' . now()->format('Y-m-d-H-i-s') . '.csv';
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
