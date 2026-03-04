@props([
    'name',
    'items'       => [],
    'selected'    => [],
    'placeholder' => 'Seçin...',
    'singularLabel' => 'seçim',
    'pluralLabel'   => 'seçildi',
    'dropdownId'    => null,
    'maxVisible'    => 4,
    'maxSelect'     => 0,
    'minSelect'     => 0,
    'multiple'      => true,
    'required'      => false,
    'disabled'      => false,
    'searchPlaceholder' => 'Ara...',
])

@php
    $uid = $dropdownId ?? $name . '_' . uniqid();
    $itemsJson = json_encode($items);
    $selectedJson = json_encode(
        collect($selected)->map(fn($v) => is_numeric($v) ? (int) $v : $v)->values()->toArray()
    );

    if ($required && $minSelect === 0) $minSelect = 1;
    if (!$multiple) $maxSelect = 1;
@endphp

<div class="relative {{ $disabled ? 'opacity-60 pointer-events-none' : '' }}"
     x-data="{
         open: false,
         search: '',
         selected: {{ $selectedJson }},
         items: {{ $itemsJson }},
         multiple: {{ $multiple ? 'true' : 'false' }},
         maxSelect: {{ (int) $maxSelect }},
         minSelect: {{ (int) $minSelect }},
         toggle(id) {
             const i = this.selected.indexOf(id);
             if (i === -1) {
                 if (this.maxSelect > 0 && this.selected.length >= this.maxSelect && this.multiple) return;
                 if (!this.multiple) {
                     this.selected = [id];
                     this.open = false;
                 } else {
                     this.selected.push(id);
                 }
             } else {
                 if (this.minSelect > 0 && this.selected.length <= this.minSelect) return;
                 this.selected.splice(i, 1);
             }
         },
         label() {
             if (!this.selected.length) return '{{ $placeholder }}';
             if (this.selected.length === 1) {
                 const f = this.items.find(i => i.id === this.selected[0]);
                 return f ? f.name : '1 {{ $singularLabel }}';
             }
             return this.selected.length + ' {{ $pluralLabel }}';
         },
         atMax() {
             return this.maxSelect > 0 && this.selected.length >= this.maxSelect;
         },
         atMin() {
             return this.minSelect > 0 && this.selected.length <= this.minSelect;
         }
     }"
     @click.outside="open = false"
     @dropdown-open.window="if ($event.detail.id !== '{{ $uid }}') open = false">

    {{-- Trigger --}}
    <button type="button"
            @click.stop="open = !open; search = ''; if (open) $dispatch('dropdown-open', { id: '{{ $uid }}' })"
            :class="selected.length ? 'ring-fuchsia-300 dark:ring-fuchsia-600 bg-fuchsia-50/50 dark:bg-fuchsia-900/10' : 'ring-slate-200 dark:ring-slate-600 bg-slate-50 dark:bg-slate-700/70'"
            class="w-full flex items-center justify-between px-4 py-3 text-sm rounded-xl ring-1 transition-all cursor-pointer">
        <span :class="selected.length ? 'text-fuchsia-700 dark:text-fuchsia-300' : 'text-slate-400'" x-text="label()"></span>
        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    {{-- Panel --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
         class="absolute z-30 mt-1 w-full bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-600 shadow-lg overflow-hidden">

        {{-- Search --}}
        <div class="px-3 py-2 border-b border-slate-100 dark:border-slate-700/50">
            <input type="text" x-model="search" @click.stop placeholder="{{ $searchPlaceholder }}"
                   class="w-full px-3 py-1.5 text-xs bg-slate-50 dark:bg-slate-700/70 border-0 rounded-lg
                          text-slate-900 dark:text-white placeholder-slate-400
                          ring-1 ring-slate-200 dark:ring-slate-600
                          focus:ring-fuchsia-500/60 focus:ring-2 transition-all">
        </div>

        {{-- Max select info --}}
        @if($maxSelect > 0 && $multiple)
        <div x-show="atMax()" class="px-3 py-1.5 bg-amber-50 dark:bg-amber-900/10 border-b border-amber-200/60 dark:border-amber-800/30">
            <p class="text-[11px] text-amber-600 dark:text-amber-400">En fazla {{ $maxSelect }} seçim yapabilirsiniz</p>
        </div>
        @endif

        {{-- Min select info --}}
        @if($minSelect > 0)
        <div x-show="atMin()" class="px-3 py-1.5 bg-blue-50 dark:bg-blue-900/10 border-b border-blue-200/60 dark:border-blue-800/30">
            <p class="text-[11px] text-blue-600 dark:text-blue-400">En az {{ $minSelect }} seçim yapmalısınız</p>
        </div>
        @endif

        {{-- Items --}}
        <div class="overflow-y-auto" style="max-height: {{ (int) $maxVisible * 44 }}px">
            <template x-for="item in items" :key="item.id">
                <div x-show="item.name.toLowerCase().includes(search.toLowerCase())"
                     @click.stop="toggle(item.id)"
                     :class="!selected.includes(item.id) && atMax() && multiple ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer'"
                     class="flex items-center gap-3 px-3 py-2.5 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors select-none">

                    @if($multiple)
                    {{-- Checkbox --}}
                    <div :class="selected.includes(item.id) ? 'bg-fuchsia-500 border-fuchsia-500' : 'border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-700'"
                         class="w-4 h-4 rounded border-2 flex items-center justify-center flex-shrink-0 transition-all">
                        <svg x-show="selected.includes(item.id)" class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    @else
                    {{-- Radio --}}
                    <div :class="selected.includes(item.id) ? 'border-fuchsia-500' : 'border-slate-300 dark:border-slate-500'"
                         class="w-4 h-4 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all bg-white dark:bg-slate-700">
                        <div x-show="selected.includes(item.id)" class="w-2 h-2 rounded-full bg-fuchsia-500"></div>
                    </div>
                    @endif

                    <span class="text-sm text-slate-700 dark:text-slate-300 flex-1" x-text="item.name"></span>
                </div>
            </template>
        </div>
    </div>

    {{-- Hidden inputs --}}
    <template x-for="id in selected" :key="id">
        <input type="hidden" :name="'{{ $name }}'" :value="id">
    </template>
</div>
