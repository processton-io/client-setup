<?php

namespace Processton\Company\Filament\Resources\CompanyResource\Actions;

use Filament\Forms\Form;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ViewAction;
use Processton\Company\Filament\Resources\CompanyResource;
use Processton\Company\Filament\Resources\CompanyResource\Mutators\BeforeView;
use Processton\Company\Models\Company;
use Processton\Contact\Filament\Resources\ContactResource;
use Processton\Contact\Models\Contact;
use Illuminate\Support\HtmlString;
use Processton\Customer\Filament\Resources\CustomerResource;

class ViewCompany
{
    public static function make(): ViewAction
    {
        return ViewAction::make()
            ->modalHeading(function ($record) {
                $status = match ($record->status ?? 'active') {
                    'active' => '<span class="ml-2 px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>',
                    'inactive' => '<span class="ml-2 px-2 py-0.5 text-xs font-medium bg-gray-200 text-gray-600 rounded-full">Inactive</span>',
                    'suspended' => '<span class="ml-2 px-2 py-0.5 text-xs font-medium bg-red-100 text-red-700 rounded-full">Suspended</span>',
                    default => '',
                };

                $link = CompanyResource::getUrl('detail.view', ['record' => $record->id]);

                return new HtmlString('
                    <div class="flex items-center w-full gap-3">
                        <svg class="fi-topbar-item-icon h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"></path>
                        </svg>
                        <div class="flex-1 text-lg font-semibold text-gray-900">
                            <span>' . e($record->name) . '</span>
                            <span class="text-sm text-gray-500 block">Company ID: ' . e($record->id) . '</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="' . $link . '" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-slate-800 text-white hover:bg-slate-700 focus-visible:ring-custom-500/50 fi-ac-action fi-ac-btn-action">
                                Detail view
                            </a>
                            <span class="text-lg font-semibold text-gray-900">
                                ' . $status . '
                            </span>
                        </div>
                    </div>
                ');
            })

            ->modalDescription(fn(Company $record): string => __("Edit {$record->name}"))
            ->modalWidth(MaxWidth::ExtraSmall)
            ->icon('lucide-view')
            ->label('')
            ->modalContent(fn($record) => view('processton-company::view-company-profile', ['record' => $record]))
            ->requiresConfirmation(false)
            ->form([])
            ->infolist([])
            ->slideOver();
    }
}
