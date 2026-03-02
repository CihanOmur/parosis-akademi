@props([
    'name',
    'accept'          => 'image/*',
    'required'        => false,
    'existing'        => null,
    'multiple'        => false,
    'label'           => 'Görsel yüklemek için tıklayın',
    'changeLabel'     => null,
    'hint'            => 'PNG, JPG, GIF, WEBP &bull; Maks. 5MB',
])

@php
    $uid = $name . '_' . uniqid();

    if (!$changeLabel) {
        $changeLabel = $multiple
            ? 'Daha fazla görsel eklemek için tıklayın'
            : 'Görseli değiştirmek için tıklayın';
    }
@endphp

@if($multiple)
{{-- ═══ MULTI MODE ═══ --}}
@php
    $existingArray = is_array($existing) ? $existing : ($existing ? [$existing] : []);
@endphp
<div x-data="{
    files: [],
    existingUrls: {{ json_encode($existingArray) }},
    addFiles(event) {
        const newFiles = Array.from(event.target.files);
        event.target.value = '';
        newFiles.forEach(file => {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.files.push({ file, preview: e.target.result });
                this.syncInput();
            };
            reader.readAsDataURL(file);
        });
    },
    removeNew(index) {
        this.files.splice(index, 1);
        this.syncInput();
    },
    removeExisting(index) {
        this.existingUrls.splice(index, 1);
    },
    syncInput() {
        const dt = new DataTransfer();
        this.files.forEach(f => dt.items.add(f.file));
        this.$refs.input.files = dt.files;
    },
    get hasImages() {
        return this.files.length > 0 || this.existingUrls.length > 0;
    }
}" class="space-y-3">

    {{-- Preview Grid --}}
    <div x-show="hasImages" x-cloak class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
        {{-- Existing images --}}
        <template x-for="(url, i) in existingUrls" :key="'ex-'+i">
            <div class="relative h-36 overflow-hidden rounded-xl border border-slate-200/50 dark:border-slate-700/50">
                <img :src="url" class="absolute inset-0 w-full h-full object-cover" />
                <button type="button" @click.prevent="removeExisting(i)"
                        class="absolute top-2 right-2 z-10 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full
                               flex items-center justify-center transition-all shadow-lg ring-2 ring-white/50 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <input type="hidden" name="existing_{{ $name }}[]" :value="url" />
            </div>
        </template>

        {{-- New file previews --}}
        <template x-for="(item, i) in files" :key="'new-'+i">
            <div class="relative h-36 overflow-hidden rounded-xl border border-fuchsia-200/50 dark:border-fuchsia-700/50">
                <img :src="item.preview" class="absolute inset-0 w-full h-full object-cover" />
                <button type="button" @click.prevent="removeNew(i)"
                        class="absolute top-2 right-2 z-10 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full
                               flex items-center justify-center transition-all shadow-lg ring-2 ring-white/50 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </template>
    </div>

    {{-- Upload area --}}
    <label class="group flex flex-col items-center justify-center gap-3 p-6 border-2 border-dashed border-slate-200 dark:border-slate-600
                  rounded-xl cursor-pointer transition-all
                  hover:border-fuchsia-400 dark:hover:border-fuchsia-500 hover:bg-fuchsia-50/50 dark:hover:bg-fuchsia-900/10">
        <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center
                    group-hover:bg-fuchsia-100 dark:group-hover:bg-fuchsia-900/30 transition-colors">
            <svg class="w-6 h-6 text-slate-400 group-hover:text-fuchsia-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
            </svg>
        </div>
        <div class="text-center">
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 group-hover:text-fuchsia-600 dark:group-hover:text-fuchsia-400 transition-colors"
               x-text="hasImages ? '{{ $changeLabel }}' : '{{ $label }}'"></p>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">{!! $hint !!}</p>
        </div>
        <input x-ref="input" type="file" name="{{ $name }}[]" accept="{{ $accept }}" multiple class="hidden"
               @if($required) x-bind:required="!hasImages" @endif
               @change="addFiles($event)">
    </label>

    @error($name)
        <p class="text-sm text-red-500 flex items-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>

@else
{{-- ═══ SINGLE MODE ═══ --}}
@php
    $existingJson = $existing ? "'" . e($existing) . "'" : 'null';
@endphp
<div x-data="{ preview: {!! $existingJson !!}, removed: false }" class="space-y-3">
    {{-- Preview --}}
    <div x-show="preview" x-cloak class="relative overflow-hidden rounded-xl border border-slate-200/50 dark:border-slate-700/50">
        <img :src="preview" class="w-full h-auto object-cover" style="display:block" />
        <button type="button" @click.prevent="preview = null; $refs.input.value = ''; removed = true"
                class="absolute top-3 right-3 z-10 w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-full
                       flex items-center justify-center transition-all shadow-lg ring-2 ring-white/50 cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Upload area --}}
    <label class="group flex flex-col items-center justify-center gap-3 p-6 border-2 border-dashed border-slate-200 dark:border-slate-600
                  rounded-xl cursor-pointer transition-all
                  hover:border-fuchsia-400 dark:hover:border-fuchsia-500 hover:bg-fuchsia-50/50 dark:hover:bg-fuchsia-900/10">
        <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center
                    group-hover:bg-fuchsia-100 dark:group-hover:bg-fuchsia-900/30 transition-colors">
            <svg class="w-6 h-6 text-slate-400 group-hover:text-fuchsia-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
            </svg>
        </div>
        <div class="text-center">
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 group-hover:text-fuchsia-600 dark:group-hover:text-fuchsia-400 transition-colors"
               x-text="preview ? '{{ $changeLabel }}' : '{{ $label }}'"></p>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">{!! $hint !!}</p>
        </div>
        <input x-ref="input" type="file" name="{{ $name }}" accept="{{ $accept }}" class="hidden"
               {{ $required ? 'required' : '' }}
               @change="const f = $event.target.files[0]; if(f) { const r = new FileReader(); r.onload = e => preview = e.target.result; r.readAsDataURL(f); }">
    </label>

    {{-- Existing gorsel silindi sinyali --}}
    <template x-if="removed">
        <input type="hidden" name="remove_{{ $name }}" value="1" />
    </template>

    @error($name)
        <p class="text-sm text-red-500 flex items-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>
@endif
