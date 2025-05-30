@php

$spacer = $element;
$spacerHeight = isset($element['height']) ? intval($element['height']) : 16;
@endphp
<div class="w-full" style="height: {{ $spacerHeight . 'px' }}"></div>