<?php

namespace App\Filament\Resources;

use App\Filament\Exports\EmployeeExporter;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\City;
use App\Models\Employee;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'HR Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('postal_code')
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('Location')
                    ->schema([
                        Forms\Components\Select::make('country_id')
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                            })
                            ->relationship('country', 'name'),
                        Forms\Components\Select::make('state_id')
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('city_id', null))
                            ->options(fn(Get $get): Collection => State::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id')),
                        Forms\Components\Select::make('city_id')
                            ->live()
                            ->options(fn(Get $get): Collection => City::query()
                                ->where('state_id', $get('state_id'))
                                ->pluck('name', 'id')),
                    ]),
                Forms\Components\Section::make('Employment Details')
                    ->schema([
                        Forms\Components\DatePicker::make('hire_date')
                            ->default(now())
                            ->required(),
                        Forms\Components\Select::make('position_id')
                            ->searchable()
                            ->preload()
                            ->relationship('position', 'title'),
                        Forms\Components\TextInput::make('salary')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'on_leave' => 'On Leave',
                            ])
                            ->default('active')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Documents')
                    ->schema([
                        Forms\Components\Repeater::make('documents')
                            ->schema([
                                Forms\Components\Select::make('document_type')
                                    ->options([
                                        'CV' => 'CV',
                                        'contract' => 'Contract',
                                        'id_card' => 'ID Card',
                                        'other' => 'Other',
                                    ]),
                                Forms\Components\FileUpload::make('file_path')
                                    ->image()
                                    ->maxSize(1024 * 1024 * 10) // 10MB
                                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('postal_code')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('country.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('hire_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('position.title')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('salary')
                    ->numeric()
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'on_leave' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('position_id')
                    ->multiple()
                    ->preload()
                    ->relationship('position', 'title'),
                Tables\Filters\SelectFilter::make('position.department_id')
                    ->multiple()
                    ->preload()
                    ->relationship('position.department', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Activo',
                        'inactive' => 'Inactivo',
                        'on_leave' => 'En licencia',
                    ]),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ExportAction::make()
                        ->exporter(EmployeeExporter::class),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(EmployeeExporter::class)
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
