<?php

namespace Processton\AccessControll\Filament\Resources;

use Processton\AccessControll\Filament\Resources\RoleResource\Pages;
use Processton\AccessControll\Filament\Resources\RoleResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Processton\AccessControll\Models\Permission;
use Processton\AccessControll\Models\Role;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Str;
use Filament\Forms\Components\Tabs;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Tabs::make('Permissions')
                    ->tabs([
                        ... self::getPermissions()
                    ])
            ])->columns(1);
    }

    public static function getPermissions()
    {

        $return = [];

        $permissions = Permission::all();

        $permissions = $permissions->map(function ($permission) {
            return [
                'id' => $permission->id,
                'name' => $permission->name,
                'group' => $permission->group,
                'sub_group' => $permission->sub_group,
                'description' => $permission->description,
            ];
        });
        $permissions = $permissions->groupBy(function ($item) {
            return $item['group'] ? $item['group'] : 'Uncategorized';
        });

        foreach ($permissions as $group => $gitems) {

            $groupReturn = [];

            $permissionsGroup = $gitems->groupBy(function ($item) {
                return $item['sub_group'] ? $item['sub_group'] : 'Uncategorized';
            });


            $rows = [];

            foreach ($permissionsGroup as $subgroup => $items) {

                $rows[] = Forms\Components\Section::make($subgroup)
                    ->schema([
                        Forms\Components\CheckboxList::make('assigned_abilities')
                            ->relationship('permissions', 'name')
                            ->label('')
                            ->options($items->pluck('name', 'id'))
                            ->descriptions($items->pluck('description', 'id'))
                            ->columns($group == 'Setup' ? 1 : 3),
                    ])->columnSpan([
                        'default' => $group == 'Setup' ? 1 : 3,
                    ]);
            }


            $return[] = Tabs\Tab::make($group)
                ->schema([
                    Grid::make([
                    'default' => 3,
                    ])
                    ->schema([
                        ...$rows
                    ])
                ]);
        }
        return $return;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->counts('permissions')
                    ->label('Permissions'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created At'),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }



    public static function getCluster(): ?string
    {
        return config('panels.access-controll.config.roles.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.access-controll.config.roles.label', 'Address');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.access-controll.config.roles.plural_label', 'Addresses');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.access-controll.config.roles.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.access-controll.config.roles.navigation_label', '');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.access-controll.config.roles.navigation_icon', 'heroicon-o-rectangle-stack');
    }

    public static function getSlug(): string
    {
        return config('panels.access-controll.config.roles.slug', 'roles');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.access-controll.config.roles.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.access-controll.config.roles.sort', null);
    }
}
