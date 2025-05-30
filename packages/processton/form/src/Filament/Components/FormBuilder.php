<?php

namespace Processton\Form\Filament\Components;

use Filament\Forms\Components\Field;

class FormBuilder extends Field
{
    protected string $view = 'processton-form::form-builder';

    public $state = [
        'rows' => [],
    ];
}
