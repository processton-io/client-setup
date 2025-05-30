<?php

namespace Processton\Company\Filament\Resources\CompanyResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Processton\Company\Filament\Resources\CompanyResource;
use Processton\Company\Filament\Resources\CompanyResource\Mutators\BeforeView;
use Processton\Company\Models\Company;
use Processton\Contact\Filament\Resources\ContactResource;
use Processton\Contact\Models\Contact;
use Illuminate\Support\HtmlString;
use Processton\Customer\Filament\Resources\CustomerResource;

class ViewCompanyDetail
{
    public static function make(): Action
    {
        return Action::make('detail_view')
            ->url(fn(Company $record): string => CompanyResource::getUrl('detail.view', ['record' => $record->id]))
            ->icon('tabler-view-360-number')
            ->label('View')
            ->requiresConfirmation(false);
    }
}
