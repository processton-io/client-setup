<?php

namespace Processton\Customer\Filament\Resources;

use Processton\Customer\Filament\Resources\CustomerResource\Pages;
use Processton\Customer\Filament\Resources\CustomerResource\RelationManagers;
use Processton\Customer\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Processton\Customer\Filament\Resources\CustomerResource\Actions\EditCustomer;
use Processton\Customer\Filament\Resources\CustomerResource\Actions\ViewCustomer;
use Processton\Customer\Filament\Resources\CustomerResource\Actions\ViewCustomerDetails;
use Processton\Customer\Filament\Resources\CustomerResource\Forms\CustomerForm;
use Processton\Customer\Filament\Resources\CustomerResource\InfoList\CustomerInfoList;
use Processton\Customer\Filament\Resources\CustomerResource\Mutators\BeforeEdit;
use stdClass;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'carbon-customer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(CustomerForm::make());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(CustomerInfoList::make());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('identifier')
                    ->label('Customer Name')
                    ->getStateUsing(
                        static function (Customer $record): string {
                            if(!$record->name);
                            return (string) (
                                $record->name
                            );
                        }
                    )
                    ->icon(fn(Customer $record): string => $record->is_personal ? 'heroicon-o-user' : 'heroicon-o-building-office')
                    ->description(fn(Customer $record): string => $record->identifier ?? '')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency.name')
                    ->label('Currency'),
                Tables\Columns\TextColumn::make('contacts.name')
                    ->label('Contact')
                    ->wrap(),
                    Tables\Columns\BooleanColumn::make('enable_portal')
                        ->label('Portal Enabled'),
                ])
            ->filters([
                Tables\Filters\Filter::make('enable_portal')
                    ->label('Portal Enabled')
                    ->query(fn (Builder $query) => $query->where('enable_portal', true)),
            ])
            ->actions([
                ViewCustomer::make(),
                ViewCustomerDetails::make(),
                EditCustomer::make()
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
            'index' => Pages\ListCustomers::route('/'),
            // 'create' => Pages\CreateCustomer::route('/create'),
            // 'edit' => Pages\EditCustomer::route('/{record}/edit'),
            'detail.view' => Pages\ViewCustomerPage::route('/{record}/detail'),
        ];
    }
}
