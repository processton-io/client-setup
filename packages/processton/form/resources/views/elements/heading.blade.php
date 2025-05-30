@php

$heading = $element;

@endphp
<div>
    @switch($heading['headingLevel'])
        @case(1)
            <h1 class="text-4xl font-bold leading-tight">{{ $heading['label'] ?? 'Heading' }}</h1>
            @break
        @case(2)
            <h2 class="text-3xl font-bold leading-tight">{{ $heading['label'] ?? 'Heading' }}</h2>
            @break
        @case(3)
            <h3 class="text-2xl font-semibold leading-tight">{{ $heading['label'] ?? 'Heading' }}</h3>
            @break
        @case(4)
            <h4 class="text-xl font-semibold leading-tight">{{ $heading['label'] ?? 'Heading' }}</h4>
            @break
        @case(5)
            <h5 class="text-lg font-medium leading-tight">{{ $heading['label'] ?? 'Heading' }}</h5>
            @break
        @case(6)
            <h6 class="text-base font-medium leading-tight">{{ $heading['label'] ?? 'Heading' }}</h6>
            @break
        @default
            <h3 class="text-2xl font-semibold leading-tight">{{ $heading['label'] ?? 'Heading' }}</h3>
            @break
    @endswitch
</div>