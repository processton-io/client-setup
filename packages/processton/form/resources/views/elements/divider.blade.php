@php

$divider = $element;

@endphp
<div class="w-full flex flex-col items-center">
    <hr class="border-t-2 border-gray-400 w-full">
    @if(isset($divider['label']))
        <span class="tabsolute left-1/2 -translate-x-1/2 bg-white px-2 text-gray-600 text-sm -mt-3 z-10">{{ $divider['label'] }}</span>
    @endif
</div>