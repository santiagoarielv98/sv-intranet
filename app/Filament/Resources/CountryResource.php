<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?int $navigationSort = 3;

    public static function getLabel(): string
    {
        return __('filament.resources.countries.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament.resources.countries.plural_label');
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
                    ->label(__('filament.forms.country.name'))
                    ->required(),
                Forms\Components\TextInput::make('iso2')
                    ->label(__('filament.forms.country.iso2'))
                    ->required(),
                Forms\Components\TextInput::make('iso3')
                    ->label(__('filament.forms.country.iso3'))
                    ->required(),
                Forms\Components\TextInput::make('numeric_code')
                    ->label(__('filament.forms.country.numeric_code')),
                Forms\Components\TextInput::make('phonecode')
                    ->label(__('filament.forms.country.phonecode'))
                    ->tel(),
                Forms\Components\TextInput::make('capital')
                    ->label(__('filament.forms.country.capital')),
                Forms\Components\TextInput::make('currency')
                    ->label(__('filament.forms.country.currency')),
                Forms\Components\TextInput::make('currency_name')
                    ->label(__('filament.forms.country.currency_name')),
                Forms\Components\TextInput::make('currency_symbol')
                    ->label(__('filament.forms.country.currency_symbol')),
                Forms\Components\TextInput::make('tld')
                    ->label(__('filament.forms.country.tld')),
                Forms\Components\TextInput::make('native')
                    ->label(__('filament.forms.country.native')),
                Forms\Components\TextInput::make('region')
                    ->label(__('filament.forms.country.region')),
                Forms\Components\TextInput::make('subregion')
                    ->label(__('filament.forms.country.subregion')),
                Forms\Components\Textarea::make('timezones')
                    ->label(__('filament.forms.country.timezones'))
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('translations')
                    ->label(__('filament.forms.country.translations'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('latitude')
                    ->label(__('filament.forms.country.latitude'))
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->label(__('filament.forms.country.longitude'))
                    ->numeric(),
                Forms\Components\TextInput::make('emoji')
                    ->label(__('filament.forms.country.emoji')),
                Forms\Components\TextInput::make('emojiU')
                    ->label(__('filament.forms.country.emojiU')),
                Forms\Components\Toggle::make('flag')
                    ->label(__('filament.forms.country.flag'))
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('filament.forms.country.is_active'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.tables.country.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso2')
                    ->label(__('filament.tables.country.iso2'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso3')
                    ->label(__('filament.tables.country.iso3'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phonecode')
                    ->label(__('filament.tables.country.phonecode'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('emoji')
                    ->label(__('filament.tables.country.flag'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.tables.country.is_active'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.tables.country.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.tables.country.updated_at'))
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
