<?php

namespace App\Filament\Personal\Resources;

use App\Filament\Personal\Resources\HolidayResource\Pages;
use App\Filament\Personal\Resources\HolidayResource\RelationManagers;
use App\Models\Holiday;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?int $navigationSort = 3;

    public static function getLabel(): string
    {
        return __('filament.resources.holidays.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament.resources.holidays.plural_label');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('calendar_id')
                    ->label(__('filament.forms.holiday.calendar'))
                    ->relationship('calendar', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('day')
                    ->label(__('filament.forms.holiday.day'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('calendar.name')
                    ->label(__('filament.tables.holiday.calendar'))
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('filament.tables.holiday.user'))
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day')
                    ->label(__('filament.tables.holiday.day'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('filament.tables.holiday.type'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'decline' => 'danger',
                        'approved' => 'success',
                        'pending' => 'warning',
                    })
                    ->formatStateUsing(fn(string $state): string => __('filament.enums.status.' . $state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.tables.holiday.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.tables.holiday.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label(__('filament.filters.holiday.type'))
                    ->options([
                        'decline' => __('filament.enums.status.decline'),
                        'approved' => __('filament.enums.status.approved'),
                        'pending' => __('filament.enums.status.pending'),
                    ]),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListHolidays::route('/'),
            'create' => Pages\CreateHoliday::route('/create'),
            'edit' => Pages\EditHoliday::route('/{record}/edit'),
        ];
    }
}
