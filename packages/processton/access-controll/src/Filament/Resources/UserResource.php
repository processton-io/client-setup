<?php

namespace Processton\AccessControll\Filament\Resources;

use App\Models\User;
use Processton\AccessControll\Filament\Resources\UserResource\Pages;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Processton\Locale\Models\Country;
use Filament\Tables\Filters\FilterSet;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->required(),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                Forms\Components\Select::make('country_id')
                    ->options(Country::all()->pluck('name', 'id'))
                    ->searchable()
                    ->label('Country')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Name')
                    ->description(fn(User $record): string => $record->email),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('address.full_address')
                    ->label('Address')
                ->description(fn(User $record): string => $record->country->name ?? '')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email_verified_at')->label('Verfied On')
                ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('country_id')
                    ->options(Country::all()->pluck('name', 'id'))
                    ->label('Country'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->visible(fn($record) => auth()->user()->hasAbility('edit user')),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn() => auth()->user()->hasAbility('delete user')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getCluster(): ?string
    {
        return config('panels.access-controll.config.users.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.access-controll.config.users.label', 'User');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.access-controll.config.users.plural_label', 'Users');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.access-controll.config.users.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.access-controll.config.users.navigation_label', '');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.access-controll.config.users.navigation_icon', 'fas-users');
    }

    public static function getSlug(): string
    {
        return config('panels.access-controll.config.users.slug', 'users');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.access-controll.config.users.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.access-controll.config.users.sort', null);
    }
}
