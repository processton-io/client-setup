<?php

namespace Processton\Contact\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Infolists\Infolist;
use Processton\Contact\Models\Contact;
use Processton\Contact\Filament\Resources\ContactResource\Pages;
use Processton\Contact\Filament\Resources\ContactResource\Forms\ContactForm;
use Processton\Contact\Filament\Resources\ContactResource\InfoList\ContactInfoList;
use Processton\Contact\Filament\Resources\ContactResource\Mutators\BeforeCreate;
use Processton\Contact\Filament\Resources\ContactResource\Mutators\BeforeEdit;
use Processton\Contact\Filament\Resources\ContactResource\Actions\CreateContact;
use Processton\Contact\Filament\Resources\ContactResource\Actions\EditContact;
use Processton\Contact\Filament\Resources\ContactResource\Actions\ViewContact;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'ri-contacts-book-line';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(ContactForm::make());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(ContactInfoList::make());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                ->description(fn(Contact $record): string => $record->email ?? ''),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('notes')->label('notes')->wrap(),
            ])
            ->actions([
                EditContact::make(),
                ViewContact::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            // 'create' => Pages\CreateCustomer::route('/create'),
            // 'edit' => Pages\EditCustomer::route('/{record}/edit'),
            'view' => Pages\ViewContact::route('/{record}'),
        ];
    }
}
