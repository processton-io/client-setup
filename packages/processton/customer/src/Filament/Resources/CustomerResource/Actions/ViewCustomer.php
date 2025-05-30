<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Actions;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Tables\Actions\ViewAction;
use Processton\Customer\Filament\Resources\CustomerResource;
use Processton\Customer\Filament\Resources\CustomerResource\Mutators\BeforeEdit;
use Processton\Customer\Models\Customer;
use Illuminate\Support\HtmlString;

class ViewCustomer
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

                $link = CustomerResource::getUrl('detail.view', ['record' => $record->id]);

                return new HtmlString('
                    <div class="flex items-center w-full gap-3">
                        <svg class="fi-topbar-item-icon h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><defs></defs><path d="m29.7554,21.3447c-.1899-.2188-.4656-.3447-.7554-.3447h-2v-2c0-1.1025-.8972-2-2-2h-4c-1.1028,0-2,.8975-2,2v2h-2c-.2898,0-.5654.126-.7554.3447-.1899.2192-.2756.5098-.2346.7969l1,7c.0703.4922.4924.8584.99.8584h10c.4976,0,.9197-.3662.99-.8584l1-7c.041-.2871-.0447-.5776-.2346-.7969Zm-8.7554-2.3447h4v2h-4v-2Zm6.1328,9h-8.2656l-.7141-5h9.6938l-.7141,5Z"></path><rect x="10" y="20" width="2" height="10"></rect><path d="m16.7808,17.875l-1.9072-2.3838-1.4419-3.6055c-.4585-1.1455-1.5518-1.8857-2.7856-1.8857h-5.646c-1.6543,0-3,1.3457-3,3v7c0,1.1025.897,2,2,2h1v8h2v-10h-3v-7c0-.5518.4487-1,1-1h5.646c.4111,0,.7759.2471.9282.6289l1.645,3.9961,2,2.5,1.5615-1.25Z"></path><path d="m4,5c0-2.2056,1.7944-4,4-4s4,1.7944,4,4c0,2.2056-1.7944,4-4,4s-4-1.7944-4-4Zm2,0c0,1.1028.897,2,2,2s2-.8972,2-2c0-1.1028-.897-2-2-2s-2,.8972-2,2Z"></path><rect id="_Transparent_Rectangle_" data-name="&amp;lt;Transparent Rectangle&amp;gt;" class="cls-1" width="32" height="32" style="fill: none"></rect></svg>
                        <div class="flex-1 text-lg font-semibold text-gray-900">
                            <span>' . e($record->name) . '</span>
                            <span class="text-sm text-gray-500 block">Customer ID: ' . e($record->id) . '</span>
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
            ->modalDescription(fn(Customer $record): string => __("Edit {$record->name}"))
            ->modalWidth('max-w-6xl')
            ->label('')
            ->icon('lucide-view')
            ->modalContent(fn($record) => view('processton-customer::view-customer-profile-basic', ['record' => $record]))
            ->requiresConfirmation(false)
            ->form([])
            ->infolist([])
            ->slideOver();
    }
}
