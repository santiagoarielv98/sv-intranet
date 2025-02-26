<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimesheetResource\Pages;
use App\Filament\Resources\TimesheetResource\RelationManagers;
use App\Models\Timesheet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimesheetResource extends Resource
{
    protected static ?string $model = Timesheet::class;
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?int $navigationSort = 3;

    public static function getLabel(): string
    {
        return __('filament.resources.timesheet.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament.resources.timesheet.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.employees-management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('calendar_id')
                    ->relationship('calendar', 'name')
                    ->label(__('filament.forms.timesheet.calendar'))
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('filament.forms.timesheet.user'))
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'work' => __('filament.enums.type.work'),
                        'pause' => __('filament.enums.type.pause'),
                    ])
                    ->label(__('filament.common.fields.type'))
                    ->required(),
                Forms\Components\DateTimePicker::make('day_in')
                    ->label(__('filament.forms.timesheet.day_in'))
                    ->required(),
                Forms\Components\DateTimePicker::make('day_out')
                    ->label(__('filament.forms.timesheet.day_out'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('calendar.name')
                    ->label(__('filament.tables.timesheet.calendar'))
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('filament.tables.timesheet.user'))
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('filament.tables.timesheet.type'))
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => __('filament.enums.type.' . $state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_in')
                    ->label(__('filament.tables.timesheet.day_in'))
                    ->dateTime()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day_out')
                    ->label(__('filament.tables.timesheet.day_out'))
                    ->dateTime()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.tables.timesheet.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.tables.timesheet.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label(__('filament.filters.timesheet.type'))
                    ->options([
                        'work' => __('filament.enums.type.work'),
                        'pause' => __('filament.enums.type.pause'),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTimesheets::route('/'),
            'create' => Pages\CreateTimesheet::route('/create'),
            'edit' => Pages\EditTimesheet::route('/{record}/edit'),
        ];
    }
}
