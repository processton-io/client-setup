@props(['disabled' => false, 'options' => []])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-gray-200 rounded-md shadow-sm py-2 px-4 text-sm']) }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
