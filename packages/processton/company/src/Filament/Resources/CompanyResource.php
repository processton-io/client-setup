<?php

namespace Processton\Company\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Infolists\Infolist;
use Processton\Company\Models\Company;
use Processton\Company\Filament\Resources\CompanyResource\Pages;
use Processton\Company\Filament\Resources\CompanyResource\Forms\CompanyForm;
use Processton\Company\Filament\Resources\CompanyResource\InfoList\CompanyInfoList;
use Processton\Company\Filament\Resources\CompanyResource\Mutators\BeforeCreate;
use Processton\Company\Filament\Resources\CompanyResource\Mutators\BeforeEdit;
use Processton\Company\Filament\Resources\CompanyResource\Actions\CreateCompany;
use Processton\Company\Filament\Resources\CompanyResource\Actions\EditCompany;
use Processton\Company\Filament\Resources\CompanyResource\Actions\ViewCompany;
use Processton\Company\Filament\Resources\CompanyResource\Actions\ViewCompanyDetail;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';



    public static function form(Form $form): Form
    {
        return $form
            ->schema(CompanyForm::make());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(CompanyInfoList::make());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->getStateUsing(
                        static function (Company $record): string {
                            if (!$record->name) dd($record->toArray());
                            return (string) (
                                $record->name
                            );
                        }
                    )
                    ->description(fn(Company $record): string => $record->domain ?? '')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('phone'),
                Tables\Columns\TextColumn::make('industry')->label('industry'),
                Tables\Columns\TextColumn::make('annual_revenue')->label('annual_revenue'),
                Tables\Columns\TextColumn::make('number_of_employees')->label('number_of_employees'),
                Tables\Columns\TextColumn::make('lead_source')->label('lead_source')
            ])
            ->actions([
                ViewCompany::make(),
                ViewCompanyDetail::make(),
                EditCompany::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompaniesPage::route('/'),
            // 'create' => Pages\CreateCustomer::route('/create'),
            // 'edit' => Pages\EditCustomer::route('/{record}/edit'),
            'detail.view' => Pages\ViewCompanyPage::route('/{record}/detail'),
        ];
    }
}
