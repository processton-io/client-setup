@php

$input = $element;

$label = $input['label'] ?? ucfirst($input['type']);
$placeholder = $input['placeholder'] ?? '';
$placeholder = $placeholder ?: 'Enter ' . strtolower($label);
$name = $input['name'] ?? strtolower(str_replace(' ', '_', $label));
$type = $input['type'] ?? 'checkbox';

$required = array_key_exists('required' , $input) && $input['required'] == 1 ? true : false;
$disabled = array_key_exists('disabled' , $input) && $input['disabled'] == 1 ? true : false;
$default = array_key_exists('default' , $input) && $input['default'] ? $input['default'] : '';
$default = old($name, $default);

@endphp
<div class="w-full">
    <label class="flex items-center">
    <input type="{{ $type }}"
        @if ($default) checked @endif
        @if ($required) required @endif
        @if ($disabled) disabled @endif
        class="mr-2" name="{{ $name }}" >
        <p>
        {{ $label }}
        @if ($required == true)
            <span class="text-red-500">*</span>
        @endif
        </p>
    </label>
</div>