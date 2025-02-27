<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 2;

    public static function getLabel(): string
    {
        return __('filament.resources.users.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament.resources.users.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.employees-management');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function getNavigationBadgeTooltip(): ?string
    {
        return __('filament.badge_tooltip.users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.common.sections.personal-information'))
                    ->columns(3)
                    ->schema(([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament.common.fields.name'))
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('filament.common.fields.email'))
                            ->email()
                            ->required(),
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label(__('filament.common.fields.email_verified_at')),
                        Forms\Components\TextInput::make('password')
                            ->label(__('filament.common.fields.password'))
                            ->password()
                            ->hiddenOn('edit')
                            ->required(),
                        Forms\Components\Select::make('roles')
                            ->label(__('filament.common.fields.roles'))
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('departments')
                            ->label(__('filament.common.fields.departments'))
                            ->relationship('departments', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                    ])),
                Forms\Components\Section::make(__('filament.common.sections.address-information'))
                    ->columns(3)
                    ->schema(([
                        Forms\Components\Select::make('country_id')
                            ->label(__('filament.common.fields.country'))
                            ->relationship('country', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('state_id')
                            ->label(__('filament.common.fields.state'))
                            ->options(fn(Get $get): Collection => State::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('city_id', null))
                            ->required(),
                        Forms\Components\Select::make('city_id')
                            ->label(__('filament.common.fields.city'))
                            ->options(fn(Get $get): Collection => City::query()
                                ->where('state_id', $get('state_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label(__('filament.common.fields.address'))
                            ->required(),
                        Forms\Components\TextInput::make('postal_code')
                            ->label(__('filament.common.fields.postal_code'))
                            ->required(),
                    ])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.common.fields.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament.common.fields.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('filament.common.fields.address'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('postal_code')
                    ->label(__('filament.common.fields.postal_code'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('departments.name')
                    ->badge()
                    ->label(__('filament.common.fields.departments'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label(__('filament.common.fields.email_verified_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.common.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.common.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
