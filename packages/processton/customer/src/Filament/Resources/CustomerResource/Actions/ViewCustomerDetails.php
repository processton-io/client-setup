<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Actions;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Tables\Actions\Action;
use Processton\Customer\Filament\Resources\CustomerResource;
use Processton\Customer\Filament\Resources\CustomerResource\Mutators\BeforeEdit;
use Processton\Customer\Models\Customer;
use Illuminate\Support\HtmlString;

class ViewCustomerDetails
{
    public static function make(): Action
    {
        return Action::make('detail_view')
            ->url(fn(Customer $record): string => CustomerResource::getUrl('detail.view', ['record' => $record->id]))
            ->icon('tabler-view-360-number')
            ->label('View')
            ->requiresConfirmation(false);
    }
}
