@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border border-gray-200 rounded-md shadow-sm py-2 px-4 text-sm']) }}>
