@php

$htmlText = $element;

@endphp
<div class="text-gray-700 text-md {{ $subheadingClass }}">{{ $htmlText['text'] ?? '' }}</div>