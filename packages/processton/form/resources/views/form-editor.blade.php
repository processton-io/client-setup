@php
    $schema = $getState() ?? ['rows' => []];
    $statePath = $getStatePath();
@endphp


<div
    x-data="formEditorV3(state)"
    x-init="
        $watch('form', value => { state = value });
        $watch('state', value => { if (JSON.stringify(form) !== JSON.stringify(value)) form = value });
    "
    class="flex min-h-[60vh] border rounded-lg bg-white m-[-25px] mt-[-33px]"
>
    <!-- Sidebar: Elements -->
    <aside class="w-48 md:w-72 h-[calc(100vh-12rem)] bg-gray-50 border-r p-4 overflow-y-auto">
        <h2 class="font-bold text-lg mb-4">Elements</h2>
        <template x-for="group in elementGroups" :key="group.key">
            <div class="mb-4">
                <h3 class="font-semibold text-gray-700 mb-2" x-text="group.label"></h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <template x-for="element in group.elements" :key="element.type">
                        <div>
                            <button type="button"
                                class="w-full text-left px-2 py-1 rounded hover:bg-blue-100 cursor-move border border-gray-200"
                                draggable="true"
                                @dragstart="onDragStartElement(element)"
                                :disabled="isElementDisabled(element)"
                                :class="isElementDisabled(element) ? 'opacity-40 cursor-not-allowed' : ''">
                                <span x-text="element.label"></span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </aside>
    <!-- Main Editor Area -->
    <main class="flex-1 p-6 overflow-y-auto h-[calc(100vh-12rem)]">
        <!-- Size Selector above -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <p class="text-gray-500 text-sm">Design your form layout and fields visually. Drag, drop, and customize elements.</p>
            </div>
            <div class="flex items-center gap-2">
                <template x-for="size in ['sm','md','lg','xl']" :key="size">
                    <button type="button"
                        class="px-3 py-1 rounded-lg border transition-all font-medium text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        :class="previewSize === size
                            ? 'bg-blue-500 text-white border-blue-500 shadow'
                            : 'bg-white text-gray-700 border-gray-300 hover:bg-blue-50'"
                        @click="previewSize = size">
                        <span x-text="size"></span>
                    </button>
                </template>
            </div>
        </div>
        <div class="space-y-4">
            <template x-for="(row, rowIndex) in form.rows" :key="row.id">
                <div class="relative">
                    <!-- Row reorder dropzone: above (for row drag only) -->
                    <div class="absolute left-0 right-0 z-40 flex justify-center items-center h-12 top-[-24px] pointer-events-auto"
                        x-show="draggedRowIndex !== null && draggedRowIndex !== rowIndex && draggedRowIndex + 1 !== rowIndex"
                        @dragover.prevent
                        @drop="onDropRow(rowIndex)"
                        @dragenter="hoveredRowDrop = rowIndex + '-reorder-above'"
                        @dragleave="hoveredRowDrop = null">
                        <div :class="hoveredRowDrop === (rowIndex + '-reorder-above') ? 'bg-green-400/60 h-10 w-full rounded shadow-[inset_0_2px_8px_0_rgba(34,197,94,0.25)]' : 'bg-green-200/60 h-10 w-full shadow-[inset_0_2px_8px_0_rgba(34,197,94,0.12)]'" class="transition-all border-2 border-dashed border-green-500"></div>
                    </div>
                    <!-- Row dropzone: above (for element drag) -->
                    <div class="absolute left-0 right-0 z-40 flex justify-center items-center h-12 top-[-24px] pointer-events-auto"
                        x-show="draggedElement"
                        @dragover.prevent
                        @drop="onDropRowWithElement(rowIndex, 'above')"
                        @dragenter="hoveredRowDrop = rowIndex + '-above'"
                        @dragleave="hoveredRowDrop = null">
                        <div :class="hoveredRowDrop === (rowIndex + '-above') ? 'bg-blue-300/60 h-10 w-full rounded shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.25)]' : 'bg-blue-100/60 h-10 w-full shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.12)]'" class="transition-all border-2 border-dashed border-blue-400"></div>
                    </div>
                    <div class="bg-white border rounded flex flex-col gap-2 relative"
                        draggable="true"
                        @dragstart="onDragStartRow(rowIndex, $event)"
                        @dragover.prevent
                        @drop="onDropRow(rowIndex)"
                        :class="(draggedRowIndex === rowIndex ? 'opacity-50' : '')"
                        @mouseenter="hoveredElement = [rowIndex, null]"
                        @mouseleave="hoveredElement = null">
                        <div class="flex">
                            <div class="flex flex-col items-center">
                                <div class="flex flex-col">
                                    <!-- Drag Row Button -->
                                    <button type="button" class="p-1 hover:bg-gray-200 rounded cursor-move" title="Drag Row">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/></svg>
                                    </button>
                                    <!-- Edit Row Button -->
                                    <button type="button" class="p-1 hover:bg-gray-200 rounded" title="Edit Row"
                                        @click.stop="editRow(rowIndex)">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-2.828 0L9 13zm-6 6h6v-6H3v6z"/></svg>
                                    </button>
                                    <!-- Delete Row Button -->
                                    <button type="button" class="p-1 hover:bg-gray-200 rounded" title="Delete Row"
                                        @click.stop="removeRow(rowIndex)">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex-1 p-2 rounded border-l border-gray-200 border-dotted">
                                <div class="grid w-full" :style="gridTemplateColumns">
                                    <template x-for="(element, elIndex) in row.elements" :key="element.id">
                                        <div class="relative group flex flex-col justify-end h-full"
                                            :style="colspanStyle(element)"
                                            @mouseenter="hoveredElement = [rowIndex, elIndex]"
                                            @mouseleave="hoveredElement = null"
                                            @click="editElement(rowIndex, elIndex)"
                                            style="cursor: pointer;"
                                            x-data="{
                                                resizing: false,
                                                startX: 0,
                                                startColspan: 0,
                                                onMouseMove(e) {
                                                    if (!this.resizing) return;
                                                    let delta = e.clientX - this.startX;
                                                    let grid = $el.parentElement.getBoundingClientRect();
                                                    let gridWidth = grid.width;
                                                    let colWidth = gridWidth / 12;
                                                    let change = Math.round(delta / colWidth);
                                                    let newColspan = Math.max(1, Math.min(12, this.startColspan + change));
                                                    if ($store.formEditorV3.previewSize === 'md') element.colspan_md = newColspan;
                                                    else if ($store.formEditorV3.previewSize === 'lg') element.colspan_lg = newColspan;
                                                    else if ($store.formEditorV3.previewSize === 'xl') element.colspan_xl = newColspan;
                                                },
                                                onMouseUp() {
                                                    this.resizing = false;
                                                    window.removeEventListener('mousemove', this.onMouseMove);
                                                    window.removeEventListener('mouseup', this.onMouseUp);
                                                },
                                                startResize(e) {
                                                    if ($store.formEditorV3.previewSize === 'sm') return;
                                                    this.resizing = true;
                                                    this.startX = e.clientX;
                                                    if ($store.formEditorV3.previewSize === 'md') this.startColspan = element.colspan_md || 12;
                                                    else if ($store.formEditorV3.previewSize === 'lg') this.startColspan = element.colspan_lg || 12;
                                                    else if ($store.formEditorV3.previewSize === 'xl') this.startColspan = element.colspan_xl || 12;
                                                    window.addEventListener('mousemove', this.onMouseMove);
                                                    window.addEventListener('mouseup', this.onMouseUp);
                                                }
                                            }"
                                            x-init="$store.formEditorV3 = $store.formEditorV3 || $data"
                                        >
                                            <!-- Dropzone: left (vertical) -->
                                            <div class="absolute top-0 bottom-0 -left-3 flex items-center z-30"
                                                x-show="draggedElement"
                                                @dragover.prevent
                                                @drop="onDropElement(rowIndex, elIndex, 'left', element)"
                                                @dragenter="hoveredDrop = [rowIndex, elIndex, 'left']"
                                                @dragleave="hoveredDrop = null">
                                                <div :class="hoveredDrop && hoveredDrop[0] === rowIndex && hoveredDrop[1] === elIndex && hoveredDrop[2] === 'left' ? 'bg-blue-300' : 'bg-blue-100'" class="w-2 h-10 rounded border-2 border-dashed border-blue-400 shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.12)]"></div>
                                            </div>
                                            <!-- Dropzone: right (vertical) -->
                                            <div class="absolute top-0 bottom-0 -right-3 flex items-center z-30"
                                                x-show="draggedElement"
                                                @dragover.prevent
                                                @drop="onDropElement(rowIndex, elIndex+1, 'right', element)"
                                                @dragenter="hoveredDrop = [rowIndex, elIndex+1, 'right']"
                                                @dragleave="hoveredDrop = null">
                                                <div :class="hoveredDrop && hoveredDrop[0] === rowIndex && hoveredDrop[1] === elIndex+1 && hoveredDrop[2] === 'right' ? 'bg-blue-300' : 'bg-blue-100'" class="w-2 h-10 rounded border-2 border-dashed border-blue-400 shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.12)]"></div>
                                            </div>
                                            <!-- Element preview: Render actual component -->
                                            <div :class="'rounded p-2 flex items-center justify-between w-full'" class="w-full border border-gray-200 border-dotted shadow-sm relative group">
                                                <!-- Heading element with level and tailwind typography -->
                                                
                                                <template x-if="element.type === 'heading'">
                                                    <component
                                                        :is="'h' + (element.headingLevel || 2)"
                                                        :class="{
                                                            1: 'text-4xl font-bold leading-tight',
                                                            2: 'text-3xl font-bold leading-tight',
                                                            3: 'text-2xl font-semibold leading-tight',
                                                            4: 'text-xl font-semibold leading-tight',
                                                            5: 'text-lg font-medium leading-tight',
                                                            6: 'text-base font-medium leading-tight'
                                                        }[element.headingLevel || 2]"
                                                        x-text="element.label"
                                                    ></component>
                                                </template>
                                                <template x-if="element.type === 'subheading'">
                                                    <div>
                                                        <div class="text-gray-500 text-sm" x-text="element.subText"></div>
                                                    </div>
                                                </template>
                                                <template x-if="element.type === 'divider'">
                                                    <div class="w-full flex flex-col items-center">
                                                        <hr class="border-t-2 border-gray-400 w-full">
                                                        <template x-if="element.label">
                                                            <span class="absolute left-1/2 -translate-x-1/2 bg-white px-2 text-gray-600 text-sm -mt-3 z-10" x-text="element.label"></span>
                                                        </template>
                                                    </div>
                                                </template>
                                                <template x-if="element.type === 'html_text'">
                                                    <div class="text-gray-700 text-md" x-text="element.text || 'Enter your text here'"></div>
                                                </template>
                                                <template x-if="element.type === 'spacer'">
                                                    <div :style="'height: ' + (element.height || 24) + 'px;'"></div>
                                                </template>
                                                <template x-if="element.type === 'text' || element.type === 'email' || element.type === 'number'">
                                                    <div class="w-full">
                                                        <label class="block text-md font-medium mb-1" x-text="element.label"></label>
                                                        <input :type="element.type" class="w-full rounded px-3 py-2 border" :placeholder="element.label" >
                                                    </div>
                                                </template>
                                                <template x-if="element.type === 'textarea'">
                                                    <div class="w-full">
                                                        <label class="block text-md font-medium mb-1" x-text="element.label"></label>
                                                        <textarea class="w-full rounded px-3 py-2 border" :placeholder="element.label" ></textarea>
                                                    </div>
                                                </template>
                                                <template x-if="element.type === 'phone'">
                                                    <div class="w-full">
                                                        <label class="block text-md font-medium mb-1" x-text="element.label"></label>
                                                        <input type="tel" class="w-full rounded p-1 border" :placeholder="element.label" >
                                                    </div>
                                                </template>
                                                <template x-if="element.type === 'select'">
                                                    <div class="w-full">
                                                        <label class="block text-md font-medium mb-1" x-text="element.label"></label>
                                                        <select class="w-full rounded px-3 py-2 border" >
                                                            <template x-for="option in (element.options ? element.options : (element.optionsText ? element.optionsText.split('\n') : []))" :key="option">
                                                                <option x-text="option"></option>
                                                            </template>
                                                        </select>
                                                    </div>
                                                </template>
                                                <template x-if="element.type === 'checkbox'">
                                                    <div class="w-full flex items-center">
                                                        <input type="checkbox" class="mr-2">
                                                        <p x-text="element.label"></p>
                                                    </div>
                                                </template>
                                                <template x-if="element.type === 'radio'">
                                                    <div>
                                                        <label class="block text-md font-medium mb-1" x-text="element.label"></label>
                                                        <div class="flex gap-2">
                                                            <input type="radio" :name="element.id" value="1"> <span>Option 1</span>
                                                            <input type="radio" :name="element.id" value="2"> <span>Option 2</span>
                                                        </div>
                                                    </div>
                                                </template>
                                                <template x-if="element.type === 'datetime'">
                                                    <div class="w-full">
                                                        <label class="block text-md font-medium mb-1" x-text="element.label"></label>
                                                        <input type="datetime-local" class="w-full rounded px-3 py-2 border" :placeholder="element.label" >
                                                    </div>
                                                </template>
                                                <!-- Fallback: show label if type not matched -->
                                                <template x-if="!['heading','subheading','divider','html_text','spacer','text','first_name','last_name','customer_name','customer_id','address_line1','address_line2','city','state','postal_code','country','short_message','bio','textarea','medium_message','large_message','email','contact_email','phone','whatsapp','contact_phone','select','prefix','customer_type','checkbox','radio','number','datetime'].includes(element.type)">
                                                    <span x-text="element.label"></span>
                                                </template>
                                                <div class="flex-1 flex items-center">
                                                    <!-- ...existing element rendering code (headings, fields, etc.)... -->
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <!-- Dropzone: empty row -->
                                    <div x-show="row.elements.length === 0" class="col-span-12 flex justify-center items-center h-16 border-2 border-dashed border-gray-300 rounded bg-gray-50 cursor-pointer w-full shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.12)]"
                                        @dragover.prevent
                                        @drop="onDropElement(rowIndex, 0, 'empty')">
                                        <span class="text-gray-400 font-semibold">Drop element here</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row reorder dropzone: below (for row drag only, after last row) -->
                    <template x-if="rowIndex === form.rows.length - 1">
                        <div class="absolute left-0 right-0 z-40 flex justify-center items-center h-12 bottom-[-24px] pointer-events-auto"
                            x-show="draggedRowIndex !== null && draggedRowIndex !== form.rows.length - 1"
                            @dragover.prevent
                            @drop="onDropRow(form.rows.length)"
                            @dragenter="hoveredRowDrop = (form.rows.length) + '-reorder-below'"
                            @dragleave="hoveredRowDrop = null">
                            <div :class="hoveredRowDrop === ((form.rows.length) + '-reorder-below') ? 'bg-green-400/60 h-10 w-full rounded shadow-[inset_0_2px_8px_0_rgba(34,197,94,0.25)]' : 'bg-green-200/60 h-10 w-full shadow-[inset_0_2px_8px_0_rgba(34,197,94,0.12)]'" class="transition-all border-2 border-dashed border-green-500"></div>
                        </div>
                    </template>
                    <!-- Row dropzone: below (for element drag, after last row) -->
                    <template x-if="rowIndex === form.rows.length - 1">
                        <div class="absolute left-0 right-0 z-40 flex justify-center items-center h-12 bottom-[-24px] pointer-events-auto"
                            x-show="draggedElement"
                            @dragover.prevent
                            @drop="onDropRowWithElement(rowIndex + 1, 'below')"
                            @dragenter="hoveredRowDrop = (rowIndex + 1) + '-below'"
                            @dragleave="hoveredRowDrop = null">
                            <div :class="hoveredRowDrop === ((rowIndex + 1) + '-below') ? 'bg-blue-300/60 h-10 w-full rounded shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.25)]' : 'bg-blue-100/60 h-10 w-full shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.12)]'" class="transition-all border-2 border-dashed border-blue-400"></div>
                        </div>
                    </template>
                </div>
            </template>
            <!-- Row dropzone at the end (if not already rendered) -->
            <template x-if="form.rows.length === 0">
                <div class="flex justify-center items-center h-8 w-full shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.12)]"
                    x-show="draggedElement"
                    @dragover.prevent
                    @drop="onDropRowWithElement(0, 'empty')"
                    @dragenter="hoveredRowDrop = 'empty'"
                    @dragleave="hoveredRowDrop = null">
                    <div :class="hoveredRowDrop === 'empty' ? 'bg-blue-300 h-8 w-2/3 rounded shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.25)]' : 'bg-blue-100 h-8 w-2/3 shadow-[inset_0_2px_8px_0_rgba(59,130,246,0.12)]'" class="transition-all border-2 border-dashed border-blue-400"></div>
                </div>
            </template>
        </div>
    </main>
    <!-- Properties Modal -->
    <div x-show="showProperties" :key="modalKey" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" x-transition>
        <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 relative">
            <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-black" @click="showProperties = false">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h2 class="font-bold text-lg mb-4">Properties</h2>
            <template x-if="editingRowIndex !== null">
                <div>
                    <label class="block mb-2">Row Class
                        <input type="text" class="w-full border rounded p-1" x-model="editingRow.class">
                    </label>
                    <button type="button" @click="saveRowProps()" class="mt-2 px-3 py-1 bg-blue-500 text-white rounded">Save</button>
                </div>
            </template>
            <template x-if="editingElementIndex !== null">
                <div>
                    <template x-if="editingElementIndex !== null && editingElement.type != 'spacer' && editingElement.type != 'subheading' && editingElement.type != 'html_text'">
                        <label class="block mb-2">
                            <span class="text-sm">Label</span>
                            <input type="text" class="w-full border rounded p-1" x-model="editingElement.label">
                        </label>
                    </template>
                    <template x-if="editingElementIndex !== null && editingElement.type == 'subheading'">
                        <label class="block mb-2">
                            <span class="text-sm">Subheading</span>
                            <textarea class="w-full border rounded p-1" x-model="editingElement.subText"></textarea>
                        </label>
                    </template>
                    <template x-if="editingElementIndex !== null && editingElement.type == 'html_text'">
                        <label class="block mb-2">
                            <span class="text-sm">Text</span>
                            <textarea class="w-full border rounded p-1" x-model="editingElement.text"></textarea>
                        </label>
                    </template>
                    <template x-if="editingElementIndex !== null && (editingElement.type != 'heading' && editingElement.type != 'subheading' && editingElement.type != 'divider' && editingElement.type != 'html_text' && editingElement.type != 'spacer')">
                        <label class="block mb-2 w-1/2">
                            <input type="checkbox" class="mr-2" x-model="editingElement.required">
                            <span class="text-sm">Required</span>
                        </label>
                    </template>
                    <template x-if="editingElementIndex !== null && (editingElement.type != 'heading' && editingElement.type != 'subheading' && editingElement.type != 'divider' && editingElement.type != 'html_text' && editingElement.type != 'spacer')">
                        <label class="block mb-2 w-1/2">
                            <input type="checkbox" class="mr-2" x-model="editingElement.disabled">
                            <span class="text-sm">Disabled</span>
                        </label>
                    </template>
                    <template x-if="editingElementIndex !== null && (editingElement.type != 'heading' && editingElement.type != 'subheading' && editingElement.type != 'divider' && editingElement.type != 'html_text' && editingElement.type != 'spacer')">
                        <label class="block mb-2">
                            <span class="text-sm">Name</span>
                            <input type="text" class="w-full border rounded p-1" x-model="editingElement.name">
                        </label>
                    </template>
                    <template x-if="editingElementIndex !== null && editingElement.type === 'heading'">
                        <div>
                            <label class="block mb-2">
                                <span class="text-sm">Heading level</span>
                                <select class="w-full border rounded p-1" x-model.number="editingElement.headingLevel">
                                    <option value="1">H1</option>
                                    <option value="2">H2</option>
                                    <option value="3">H3</option>
                                    <option value="4">H4</option>
                                    <option value="5">H5</option>
                                    <option value="6">H6</option>
                                </select>
                            </label>
                        </div>
                    </template>
                    <div class="grid grid-cols-2 gap-2 mb-2">
                        <label class="block text-sm">
                            <span class="text-sm">Colspan (sm)</span>
                            <select class="w-full border rounded p-1" x-model.number="editingElement.colspan_sm">
                                <template x-for="n in 12" :key="n">
                                    <option :value="n" x-text="n"></option>
                                </template>
                            </select>
                        </label>
                        <label class="block text-sm">
                            <span class="text-sm">Colspan (md)</span>
                            <select class="w-full border rounded p-1" x-model.number="editingElement.colspan_md">
                                <template x-for="n in 12" :key="n">
                                    <option :value="n" x-text="n"></option>
                                </template>
                            </select>
                        </label>
                        <label class="block text-sm">
                            <span class="text-sm">Colspan (lg)</span>
                            <select class="w-full border rounded p-1" x-model.number="editingElement.colspan_lg">
                                <template x-for="n in 12" :key="n">
                                    <option :value="n" x-text="n"></option>
                                </template>
                            </select>
                        </label>
                        <label class="block text-sm">
                            <span class="text-sm">Colspan (xl)</span>
                            <select class="w-full border rounded p-1" x-model.number="editingElement.colspan_xl">
                                <template x-for="n in 12" :key="n">
                                    <option :value="n" x-text="n"></option>
                                </template>
                            </select>
                        </label>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <button type="button" @click="saveElementProps()" class="px-3 py-1 bg-blue-500 text-white rounded">Save</button>
                        <button type="button" @click="removeElement(editingElementRowIndex, editingElementIndex)" class="px-3 py-1 bg-red-500 text-white rounded">Delete</button>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteConfirm" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" x-transition>
        <div class="bg-white w-full max-w-sm rounded-lg shadow-lg p-6 relative">
            <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-black" @click="showDeleteConfirm = false">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h2 class="font-bold text-lg mb-4">Delete Element</h2>
            <p class="mb-4">Are you sure you want to delete this element?</p>
            <div class="flex justify-end gap-2">
                <button type="button" class="px-3 py-1 rounded border" @click="showDeleteConfirm = false">Cancel</button>
                <button type="button" class="px-3 py-1 bg-red-500 text-white rounded" @click="confirmDeleteElement()">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
function formEditorV3(initialSchema = {rows: []}) {
    return {
        // --- Element groups and types ---
        elementGroups: [
            { label: 'HTML', key: 'html', elements: [
                { type: 'heading', label: 'Heading', headingLevels: [1,2,3,4,5,6] },
                { type: 'subheading', label: 'Subheading' },
                { type: 'divider', label: 'Divider' },
                { type: 'html_text', label: 'Text' },
                { type: 'spacer', label: 'Empty Space', heights: [12,16,18,24,32,36,48] }
            ]},
            { label: 'Form Elements', key: 'form_elements', elements: [
                { type: 'text', label: 'Text', customProps: true },
                { type: 'textarea', label: 'Textarea', customProps: true },
                { type: 'select', label: 'Select', customProps: true },
                { type: 'number', label: 'Number', customProps: true },
                { type: 'datetime', label: 'Date Time', customProps: true },
                { type: 'checkbox', label: 'Checkbox', customProps: true },
                { type: 'radio', label: 'Radio Group', customProps: true },
                { type: 'email', label: 'Email', customProps: true }
            ]}
        ],
        // --- Form state ---
        form: { rows: initialSchema.rows || [] },
        initialSchema,
        // --- Drag state ---
        draggedElement: null,
        draggedRowIndex: null,
        hoveredDrop: null,
        hoveredRowDrop: null,
        hoveredElement: null,
        // --- Properties panel state ---
        showProperties: false,
        editingRowIndex: null,
        editingRow: {},
        editingElementIndex: null,
        editingElement: {},
        hasOpenedElementModal: false, // Track if modal has ever been opened
        modalKey: 0, // Used to force modal re-render
        // --- Delete confirmation modal state ---
        showDeleteConfirm: false,
        deleteTarget: null, // { rowIdx, elIdx }
        // --- Preview size ---
        previewSize: 'md',
        resizing: null, // {rowIdx, elIdx, startX, startColspan}
        // --- Drag and drop logic ---
        onDragStartElement(element) {
            this.draggedElement = JSON.parse(JSON.stringify(element));
        },
        onDropElement(rowIdx, elIdx, position, refElement = null) {
            if (!this.draggedElement) return;
            let defaultValue = {};
            if (this.draggedElement.type === 'heading') defaultValue = { headingLevel: 2, label: 'Heading Here' };
            if (this.draggedElement.type === 'subheading') defaultValue = { subText: 'Subheading here.' };
            if (this.draggedElement.type === 'divider') defaultValue = {};
            if (this.draggedElement.type === 'text' && !this.draggedElement.inputType) defaultValue = { label: 'Text', value: 'Sample text content goes here.' };
            let colspan = 12;
            // X-axis drop: adjust colspans for md/lg/xl
            if ((position === 'left' || position === 'right') && refElement) {
                // Only adjust for md/lg/xl, keep sm as is
                let prev = refElement;
                let prev_md = prev.colspan_md || 12;
                let prev_lg = prev.colspan_lg || 12;
                let prev_xl = prev.colspan_xl || 12;
                // Minimum colspan for any element is 1
                let new_md = Math.max(1, Math.floor(prev_md / 2));
                let new_lg = Math.max(1, Math.floor(prev_lg / 2));
                let new_xl = Math.max(1, Math.floor(prev_xl / 2));
                // Remaining goes to dropped element
                let drop_md = prev_md - new_md;
                let drop_lg = prev_lg - new_lg;
                let drop_xl = prev_xl - new_xl;
                // Update previous element
                prev.colspan_md = new_md;
                prev.colspan_lg = new_lg;
                prev.colspan_xl = new_xl;
                // Dropped element colspans
                colspan = prev.colspan_sm || 12;
                const newElement = {
                    ...this.draggedElement,
                    ...defaultValue,
                    id: Date.now() + Math.random(),
                    required: false,
                    colspan: colspan,
                    colspan_sm: colspan,
                    colspan_md: drop_md,
                    colspan_lg: drop_lg,
                    colspan_xl: drop_xl,
                    optionsText: (this.draggedElement.type === 'select' || this.draggedElement.type === 'prefix') ? (this.draggedElement.options ? this.draggedElement.options.join('\n') : '') : undefined
                };
                if (position === 'left') {
                    this.form.rows[rowIdx].elements.splice(elIdx, 0, newElement);
                } else {
                    this.form.rows[rowIdx].elements.splice(elIdx, 0, newElement);
                }
            } else {
                // Default behavior for top/bottom/empty
                const newElement = {
                    ...this.draggedElement,
                    ...defaultValue,
                    id: Date.now() + Math.random(),
                    required: false,
                    colspan: colspan,
                    colspan_sm: colspan,
                    colspan_md: colspan,
                    colspan_lg: colspan,
                    colspan_xl: colspan,
                    optionsText: (this.draggedElement.type === 'select' || this.draggedElement.type === 'prefix') ? (this.draggedElement.options ? this.draggedElement.options.join('\n') : '') : undefined
                };
                this.form.rows[rowIdx].elements.splice(elIdx, 0, newElement);
            }
            this.draggedElement = null;
            this.hoveredDrop = null;
        },
        onDragStartRow(rowIdx, event) {
            this.draggedRowIndex = rowIdx;
            // Required for HTML5 drag API
            if (event && event.dataTransfer) {
                event.dataTransfer.effectAllowed = 'move';
                event.dataTransfer.setData('text/plain', rowIdx);
            }
        },
        onDropRow(targetIdx) {
            let from = this.draggedRowIndex;
            if (from !== null && from !== targetIdx && from + 1 !== targetIdx) {
                const moved = this.form.rows.splice(from, 1)[0];
                if (from < targetIdx) targetIdx--;
                this.form.rows.splice(targetIdx, 0, moved);
            }
            this.draggedRowIndex = null;
            this.hoveredRowDrop = null;
        },
        onDropRowWithElement(targetIdx, position) {
            if (!this.draggedElement) return;
            // Always insert a new row at the target index
            let defaultValue = {};
            if (this.draggedElement.type === 'heading') defaultValue = { headingLevel: 2, label: 'Heading Here' };
            if (this.draggedElement.type === 'subheading') defaultValue = { subText: 'Subheading here.' };
            if (this.draggedElement.type === 'divider') defaultValue = {};
            if (this.draggedElement.type === 'text' && !this.draggedElement.inputType) defaultValue = { label: 'Text', value: 'Sample text content goes here.' };
            const newElement = {
                ...this.draggedElement,
                ...defaultValue,
                id: Date.now() + Math.random(),
                required: false,
                colspan: 12,
                colspan_sm: 12,
                colspan_md: 12,
                colspan_lg: 12,
                colspan_xl: 12,
                optionsText: (this.draggedElement.type === 'select' || this.draggedElement.type === 'prefix') ? (this.draggedElement.options ? this.draggedElement.options.join('\n') : '') : undefined
            };
            // Insert a new row at the target index
            this.form.rows.splice(targetIdx, 0, { id: Date.now() + Math.random(), class: '', elements: [newElement] });
            this.draggedElement = null;
            this.hoveredRowDrop = null;
        },
        // --- Row logic ---
        addRow() {
            this.form.rows.push({ id: Date.now() + Math.random(), class: '', elements: [] });
        },
        removeRow(idx) {
            this.form.rows.splice(idx, 1);
        },
        editRow(idx) {
            this.editingRowIndex = idx;
            this.editingRow = { ...this.form.rows[idx] };
            this.showProperties = true;
            this.editingElementIndex = null;
        },
        saveRowProps() {
            if (this.editingRowIndex !== null) {
                this.form.rows[this.editingRowIndex].class = this.editingRow.class;
                this.showProperties = false;
            }
        },
        // --- Element logic ---
        removeElement(rowIdx, elIdx) {
            this.deleteTarget = { rowIdx, elIdx };
            this.showDeleteConfirm = true;
        },
        editElement(rowIdx, elIdx) {
            const el = this.form.rows[rowIdx].elements[elIdx];
            // Ensure all colspan properties are set (default to 12 if missing)
            this.editingElementIndex = elIdx;
            this.editingElementRowIndex = rowIdx; // <-- Store the row index
            this.editingElement = {
                ...el,
                colspan_sm: el.colspan_sm ?? 12,
                colspan_md: el.colspan_md ?? 12,
                colspan_lg: el.colspan_lg ?? 12,
                colspan_xl: el.colspan_xl ?? 12,
            };
            this.editingRowIndex = null;
            if (!this.hasOpenedElementModal) {
                this.showProperties = false;
                this.hasOpenedElementModal = true;
                this.modalKey++;
                this.$nextTick(() => { this.showProperties = true; });
            } else {
                this.showProperties = true;
            }
        },
        saveElementProps() {
            if (this.editingElementIndex !== null) {
                for (let row of this.form.rows) {
                    const idx = row.elements.findIndex(e => e.id === this.editingElement.id);
                    if (idx !== -1) {
                        row.elements[idx] = { ...this.editingElement };
                        break;
                    }
                }
                this.showProperties = false;
            }
        },
        confirmDelete(rowIdx, elIdx) {
            this.showDeleteModal = true;
            this.deleteElementRowIndex = rowIdx;
            this.deleteElementIndex = elIdx;
        },
        confirmDeleteElement() {
            if (this.deleteTarget) {
                this.form.rows[this.deleteTarget.rowIdx].elements.splice(this.deleteTarget.elIdx, 1);
                this.deleteTarget = null;
            }
            this.showDeleteConfirm = false;
            this.showProperties = false; // Close the edit element modal after delete
        },
        // --- Utility ---
        gridTemplateColumns() {
            // Responsive grid columns for the selected preview size
            let cols = 12;
            return `grid-template-columns: repeat(${cols}, minmax(0, 1fr));`;
        },
        colspanStyle(element) {
            let c = 12;
            if (this.previewSize === 'sm' && element.colspan_sm) c = element.colspan_sm;
            else if (this.previewSize === 'md' && element.colspan_md) c = element.colspan_md;
            else if (this.previewSize === 'lg' && element.colspan_lg) c = element.colspan_lg;
            else if (this.previewSize === 'xl' && element.colspan_xl) c = element.colspan_xl;
            return `grid-column: span ${c} / span ${c}`;
        },
        isElementDisabled(element) {
            // Only allow reuse for HTML and Custom elements
            const htmlTypes = ['heading', 'subheading', 'divider', 'html_text', 'spacer'];
            if (htmlTypes.includes(element.type) || element.customProps) return false;
            // Prevent reuse for all other elements (must check all rows for any instance)
            for (const row of this.form.rows) {
                for (const el of row.elements) {
                    if (el.type === element.type) {
                        return true;
                    }
                }
            }
            return false;
        },
        startResize(rowIdx, elIdx, event) {
            const element = this.form.rows[rowIdx].elements[elIdx];
            let startColspan = 12;
            if (this.previewSize === 'md') startColspan = element.colspan_md || 12;
            else if (this.previewSize === 'lg') startColspan = element.colspan_lg || 12;
            else if (this.previewSize === 'xl') startColspan = element.colspan_xl || 12;
            this.resizing = { rowIdx, elIdx, startX: event.clientX, startColspan };
            document.body.style.userSelect = 'none';
            window.addEventListener('mousemove', this.onResizeMove);
            window.addEventListener('mouseup', this.stopResize);
        },
        onResizeMove: null, // will be set in init
        stopResize: null, // will be set in init
        init() {
            this.onResizeMove = (e) => {
                if (!this.resizing) return;
                const { rowIdx, elIdx, startX, startColspan } = this.resizing;
                const grid = e.target.closest('.grid');
                if (!grid) return;
                const gridRect = grid.getBoundingClientRect();
                const gridWidth = gridRect.width;
                let deltaPx = e.clientX - startX;
                let colWidth = gridWidth / 12;
                let deltaCols = Math.round(deltaPx / colWidth);
                let newColspan = Math.max(1, Math.min(12, startColspan + deltaCols));
                const element = this.form.rows[rowIdx].elements[elIdx];
                if (this.previewSize === 'md') element.colspan_md = newColspan;
                else if (this.previewSize === 'lg') element.colspan_lg = newColspan;
                else if (this.previewSize === 'xl') element.colspan_xl = newColspan;
            };
            this.stopResize = () => {
                this.resizing = null;
                document.body.style.userSelect = '';
                window.removeEventListener('mousemove', this.onResizeMove);
                window.removeEventListener('mouseup', this.stopResize);
            };
        },
    }
}
document.addEventListener('alpine:init', () => {
    Alpine.data('formEditorV3', formEditorV3);
    setTimeout(() => {
        if (window.formEditorV3 && typeof window.formEditorV3.init === 'function') {
            window.formEditorV3.init();
        }
    }, 0);
});
</script>
<style>
button, [type="button"] {
    color: #000 !important;
    border-color: #000 !important;
}
button:hover, [type="button"]:hover {
    background: #f3f3f3 !important;
    border-color: #000 !important;
    color: #000 !important;
}
/* Minimal styling for demo, add your own for production */
</style>
