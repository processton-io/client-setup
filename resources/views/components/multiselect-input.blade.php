@props(['disabled' => false, 'options' => [], 'name' => ''])

<div x-data="multiSelect()" class="w-full">
    <!-- Selected Tags -->
    <div class="flex flex-wrap flex-col space-y-2 p-0">
        <div class="flex flex-wrap p-0 gap-2">
            <template x-for="(selected, index) in selectedOptions" :key="index">
                <div class="flex items-center border px-2 py-1 rounded-md text-sm">
                    <span x-text="options[selected]"></span>(<span x-text="selected"></span>)
                    <button type="button" class="ml-2 text-red-500 hover:text-red-700" @click="removeOption(selected)">
                        &times;
                    </button>
                </div>
            </template>
        </div>
        <input
            type="text"
            class="flex-grow focus:outline-none text-sm border border-gray-300 rounded-md"
            placeholder="Select options..."
            @click="open = true"
            @keydown.enter.prevent="addOption($event.target.value)"
            x-model="search"
            :disabled="disabled"
        >
    </div>

    <!-- Dropdown Options -->
    <div x-show="open" @click.away="open = false" class="border border-gray-300 rounded-md mt-1 bg-white shadow-md max-h-40 overflow-y-auto">
        <template x-for="(label, value) in filteredOptions" :key="value">
            <div
                class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-sm"
                @click="addOption(value)"
                x-text="label"
            ></div>
        </template>
    </div>
    <!-- Hidden Select for Form Submission -->
    <select multiple class="sr-only {{ $attributes->get('class') }}" name="{{ $name }}[]" id="{{ $name }}">
        <option x-for="selected in selectedOptions" :key="selected" :value="selected" selected x-text="options[selected]"></option>
    </select>

</div>

<script>
    function multiSelect() {
        return {
            open: false,
            search: '',
            selectedOptions: [],
            options: @json($options),
            get filteredOptions() {
                const search = this.search.toLowerCase();
                return Object.fromEntries(
                    Object.entries(this.options).filter(([value, label]) =>
                        label.toLowerCase().includes(search) && !this.selectedOptions.includes(value)
                    )
                );
            },
            addOption(value) {
                if (value && !this.selectedOptions.includes(value)) {
                    this.selectedOptions.push(value); // Add the value to the array
                    this.search = '';
                    this.open = false;
                }
            },
            removeOption(value) {
                this.selectedOptions = this.selectedOptions.filter(option => option !== value); // Remove the value from the array
            }
        };
    }
</script>
