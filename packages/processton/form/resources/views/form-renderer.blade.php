@php
    $schema = $form->schema ?? ['rows' => []];
@endphp
<form class="grid gap-4 grid-cols-12 p-4" method="POST">
    @csrf
    @foreach (($schema['rows'] ?? []) as $row)  
        <div class="col-span-12 grid gap-4 grid-cols-12 {{ $row['class'] ?? '' }}">
            @foreach (($row['elements'] ?? []) as $element)
                @php
                    $colspan = 12;
                    $colspansm = 12;
                    $colspanmd = 12;
                    $colspanlg = 12;
                    $colspanxl = 12;
                    if (isset($element['colspan_xs'])) $colspan = $element['colspan_xs'];
                    if (isset($element['colspan_sm'])) $colspansm = $element['colspan_sm'];
                    if (isset($element['colspan_md'])) $colspanmd = $element['colspan_md'];
                    if (isset($element['colspan_lg'])) $colspanlg = $element['colspan_lg'];
                    if (isset($element['colspan_xl'])) $colspanxl = $element['colspan_xl'];
                @endphp
                @php
                    // Track previous element type in the row
                    static $prevElementType = null;
                    $subheadingClass = '';
                    if ($element['type'] === 'subheading' && $prevElementType === 'heading') {
                        $subheadingClass = '-mt-4';
                    }
                @endphp
                <div class="col-span-{{$colspan}} sm:col-span-{{$colspansm}} md:col-span-{{$colspanmd}} lg:col-span-{{$colspanlg}} xl:col-span-{{$colspanxl}}">
                    @switch($element['type'])
                        @case('heading')
                            @include('processton-form::elements.heading', ['element' => $element, 'subheadingClass' => $subheadingClass])
                            @break
                        @case('subheading')
                            @include('processton-form::elements.subheading', ['element' => $element, 'subheadingClass' => $subheadingClass])
                            @break
                        @case('divider')
                            @include('processton-form::elements.divider', ['element' => $element])
                            @break
                        @case('html_text')
                            @include('processton-form::elements.html_text', ['element' => $element, 'subheadingClass' => $subheadingClass])
                            @break
                        @case('spacer')
                            @include('processton-form::elements.space', ['element' => $element])
                            @break
                        @case('text')
                        @case('email')
                        @case('number')
                            @include('processton-form::elements.text_input', ['element' => $element])
                            @break
                        @case('datetime')
                            @include('processton-form::elements.date_time_input', ['element' => $element])
                            @break
                        @case('textarea')
                            @include('processton-form::elements.textarea_input', ['element' => $element])
                            @break
                        @case('select')
                            @include('processton-form::elements.select_input', ['element' => $element])
                            @break
                        @case('checkbox')
                            @include('processton-form::elements.checkbox_input', ['element' => $element])
                            @break
                        @default
                            <div class="text-gray-400">Unknown element: {{ $element['type'] }}</div>
                    @endswitch
                </div>
                @php $prevElementType = $element['type']; @endphp
            @endforeach
        </div>
    @endforeach
    <div class="text-right space-x-4 col-span-12 ">
        <button type="reset" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Reset</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
    </div>
</form>
<style>
    h1,h2,h3,h4,h5,h6 {
        margin-block-start: 0px;
        margin-block-end: 0px;
    }
</style>