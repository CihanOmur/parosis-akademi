@php
    $c = $competition ?? null;
    $selectedCategoryIds = $c ? $c->categories->pluck('id')->toArray() : array_map('intval', (array) old('categories', []));
    $countries = [
        'Türkiye','Almanya','Amerika Birleşik Devletleri','Avusturya','Azerbaycan','Belçika',
        'Birleşik Krallık','Bosna-Hersek','Bulgaristan','Çekya','Danimarka','Estonya','Finlandiya',
        'Fransa','Gürcistan','Hırvatistan','Hollanda','İrlanda','İspanya','İsrail','İsveç','İsviçre',
        'İtalya','Japonya','Kanada','Karadağ','Kazakistan','Kıbrıs','Kuveyt','Letonya','Litvanya',
        'Lüksemburg','Macaristan','Makedonya','Malta','Norveç','Polonya','Portekiz','Romanya',
        'Rusya','Sırbistan','Singapur','Slovakya','Slovenya','Suudi Arabistan','Ukrayna','Yunanistan'
    ];
@endphp
<div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none"></div>

    <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
            <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172"/>
            </svg>
        </div>
        <div>
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Yarışma Bilgileri</h3>
            <p class="text-xs text-slate-400 mt-0.5">Sadece yarışma adı zorunlu</p>
        </div>
    </div>

    <div class="relative p-6 space-y-5">
        <x-text-input name="name" label="Yarışma Adı" placeholder="Örn: Fibonacci Robot Olimpiyatları 2026" value="{{ old('name', $c?->name) }}" required />

        <x-text-input name="organizer" label="Düzenleyen Kurum" placeholder="Örn: Fibonacci Uluslararası Bilim Komitesi" value="{{ old('organizer', $c?->organizer) }}" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Ülke</label>
                <select name="country"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-fuchsia-500/30 focus:border-fuchsia-500">
                    <option value="">— Seçim yapın —</option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}" {{ old('country', $c?->country) === $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
            </div>
            <x-text-input name="city" label="Şehir" placeholder="Örn: İstanbul" value="{{ old('city', $c?->city) }}" />
        </div>

        <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-text-input type="date" name="start_date" label="Başlangıç Tarihi" value="{{ old('start_date', optional($c?->start_date)->format('Y-m-d')) }}" />
            <x-text-input type="date" name="end_date" label="Bitiş Tarihi" value="{{ old('end_date', optional($c?->end_date)->format('Y-m-d')) }}" />
        </div>

        <x-text-input type="date" name="internal_deadline" label="Kurum İçi Son Kayıt Tarihi (evrak + ödeme)" value="{{ old('internal_deadline', optional($c?->internal_deadline)->format('Y-m-d')) }}" />

        <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

        {{-- Yarışma Kategorileri — projedeki aramalı seçim komponenti --}}
        <div>
            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">
                Yarışma Kategorileri
            </label>

            <x-checkbox-dropdown
                name="categories[]"
                :items="$allCategories->map(fn($cat) => ['id' => $cat->id, 'name' => $cat->name])->values()->toArray()"
                :selected="$selectedCategoryIds"
                placeholder="Kategori seçin..."
                searchPlaceholder="Kategori ara..."
                singularLabel="kategori"
                pluralLabel="kategori seçildi"
                :maxVisible="6"
            />

            {{-- Inline yeni kategori ekleme (havuza eklemeden direkt forma) --}}
            <div x-data="{ newCat: '', newCats: [], add() { const v = this.newCat.trim(); if (!v) return; if (this.newCats.includes(v)) { this.newCat = ''; return; } this.newCats.push(v); this.newCat = ''; } }" class="mt-2">
                <div class="flex gap-2">
                    <input type="text" x-model="newCat"
                           @keydown.enter.prevent="add()"
                           placeholder="Yeni kategori adı yazıp Enter'a basın veya + tıklayın"
                           class="flex-1 px-3 py-2 text-sm rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-fuchsia-500/30 focus:border-fuchsia-500">
                    <button type="button" @click="add()"
                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-white bg-slate-700 hover:bg-slate-800 rounded-xl transition-all whitespace-nowrap">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Ekle
                    </button>
                </div>
                <template x-if="newCats.length">
                    <div class="flex flex-wrap gap-1.5 mt-2">
                        <template x-for="(cat, i) in newCats" :key="i">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold text-white bg-gradient-to-r from-fuchsia-500 to-purple-600">
                                <span x-text="cat"></span>
                                <button type="button" @click="newCats.splice(i, 1)" class="hover:bg-white/20 rounded p-0.5 transition-all">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                <input type="hidden" name="categories[]" :value="cat">
                            </span>
                        </template>
                    </div>
                </template>
            </div>
        </div>

        <x-text-input type="url" name="website_url" label="Yarışma Web Linki (opsiyonel)" placeholder="https://..." value="{{ old('website_url', $c?->website_url) }}" />

        <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

        <x-textarea name="description" label="Açıklama (opsiyonel)" placeholder="Yarışma hakkında dahili notlar, ödüller..." rows="4">{{ old('description', $c?->description) }}</x-textarea>

        @isset($c)
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $c->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-slate-300 text-fuchsia-600 focus:ring-fuchsia-500">
                <span class="text-sm text-slate-600 dark:text-slate-300">Aktif</span>
            </label>
        @endisset
    </div>
</div>
