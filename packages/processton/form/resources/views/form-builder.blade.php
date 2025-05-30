<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    :has-inline-label="false"
>
    <x-slot
        name="label"
    >
    </x-slot>

    <x-filament::input.wrapper
        :disabled="$isDisabled"
        :valid="! $errors->has($statePath)"
        :attributes="
            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                ->class(['fi-fo-formBuilder'])
        "
    >
        <div
            x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }"
            x-init="
                $nextTick(() => {
                    if (!state || !state.rows) state = { rows: [] };
                });
            "
        >
            <div
                x-data="formEditorV3(state)"
                x-init="
                    $watch('form', value => { state = value });
                    $watch('state', value => { if (JSON.stringify(form) !== JSON.stringify(value)) form = value });
                "
            >
                @include('processton-form::form-editor')
            </div>
        </div>
    </x-filament::input.wrapper>
</x-dynamic-component>
