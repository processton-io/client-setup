@php

$heading = $element;

@endphp
<div class="text-gray-500 text-sm {{ $subheadingClass }}">{{ $heading['subText'] ?? 'Subheading' }}</div>