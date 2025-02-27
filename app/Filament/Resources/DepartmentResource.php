<?php

namespace App\Filament\Resources;

use App\Filament\Exports\DepartmentExporter;
use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;
    protected static ?string $navigationGroup = 'System Management';
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?int $navigationSort = 7;

    public static function getLabel(): string
    {
        return __('filament.resources.departments.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament.resources.departments.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.system-management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.forms.department.name'))
                    ->required(),
                // Forms\Components\Textarea::make('description')
                //     ->label(__('filament.forms.department.description')),
                // Forms\Components\Select::make('manager_id')
                //     ->relationship('manager', 'name')
                //     ->label(__('filament.forms.department.manager')),
                // Forms\Components\Select::make('parent_id')
                //     ->relationship('parent', 'name')
                //     ->label(__('filament.forms.department.parent')),
                // Forms\Components\Toggle::make('is_active')
                //     ->label(__('filament.forms.department.is_active'))
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\ExportAction::make()
                    ->exporter(DepartmentExporter::class)
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.tables.department.name'))
                    ->searchable(),
                // Tables\Columns\TextColumn::make('description')
                //     ->label(__('filament.tables.department.description'))
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.tables.department.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.tables.department.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('deleted_at')
                //     ->label(__('filament.tables.department.deleted_at'))
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\ExportBulkAction::make()
                    ->exporter(DepartmentExporter::class)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
