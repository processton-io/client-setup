@php

$input = $element;

$showLabel = array_key_exists('show_label', $input) ? $input['show_label'] : true;
$label = $input['label'] ?? ucfirst($input['type']);
$placeholder = $input['placeholder'] ?? '';
$placeholder = $placeholder ?: 'Enter ' . strtolower($label);
$name = $input['name'] ?? strtolower(str_replace(' ', '_', $label));
$type = $input['type'] ?? 'text';

$required = array_key_exists('required' , $input) && $input['required'] == 1 ? true : false;
$disabled = array_key_exists('disabled' , $input) && $input['disabled'] == 1 ? true : false;
$default = array_key_exists('default' , $input) && $input['default'] ? $input['default'] : '';
$default = old($name, $default);

if($required && !$showLabel) {
    $placeholder .= ' (required)';
}

@endphp
<div class="w-full">
    @if ($showLabel)
    <label class="block text-sm font-medium mb-1">
        {{ $label }}
        @if ($required == true)
            <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    <input type="{{ $type }}" value="{{ $default }}" 
    @if ($required) required @endif
    @if ($disabled) disabled @endif
    class="w-full border rounded px-3 py-2" name="{{ $name }}" placeholder="{{ $placeholder }}" >
</div>