@props([
    'prefix' => null,
    'suffix' => null,
])

<dt
    {{ $attributes->class(['fi-in-entry-wrp-label inline-flex items-center gap-x-3']) }}
>
    {{ $prefix }}

    <span class="text-sm font-medium leading-6 text-gray-950">
        {{ $slot }}
    </span>

    {{ $suffix }}
</dt>
