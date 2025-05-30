<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\ViewAction;
use Processton\Items\Filament\Resources\ItemsResource;
use Processton\Items\Filament\Resources\ItemsResource\Mutators\BeforeView;
use Processton\Items\Models\Items;

class ViewItems
{
    public static function make(): ViewAction
    {
        return ViewAction::make()
            ->modalHeading(fn(Items $record): string => __("View ".('View' === 'Create' ? 'New ' : 'Edit').('View' === 'Create' ? "items" : $record->name)))
            ->mutateFormDataUsing(fn(array $data) => BeforeView::mutate($data))
            ->modalWidth('7xl')
            ->form(fn(Form $form) => ItemsResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
