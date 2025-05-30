@props([
    'footer' => null,
    'header' => null,
    'headerGroups' => null,
    'reorderable' => false,
    'reorderAnimationDuration' => 300,
])

<table
    {{ $attributes->class(['fi-ta-table w-full table-auto divide-y divide-gray-200 text-start']) }}
>
    @if ($header)
        <thead class="divide-y divide-gray-200">
            @if ($headerGroups)
                <tr class="bg-gray-100">
                    {{ $headerGroups }}
                </tr>
            @endif

            <tr class="bg-gray-50">
                {{ $header }}
            </tr>
        </thead>
    @endif

    <tbody
        @if ($reorderable)
            x-on:end.stop="$wire.reorderTable($event.target.sortable.toArray())"
            x-sortable
            data-sortable-animation-duration="{{ $reorderAnimationDuration }}"
        @endif
        class="divide-y divide-gray-200 whitespace-nowrap"
    >
        {{ $slot }}
    </tbody>

    @if ($footer)
        <tfoot class="bg-gray-50">
            <tr>
                {{ $footer }}
            </tr>
        </tfoot>
    @endif
</table>
