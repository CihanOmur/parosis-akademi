@php $c = $competition ?? null; @endphp
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
        <x-text-input name="name" label="Yarışma Adı" placeholder="Örn: Robotex Türkiye 2026" value="{{ old('name', $c?->name) }}" required />

        <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-text-input name="organizer" label="Düzenleyen Kurum (opsiyonel)" placeholder="Örn: FIRST, Tübitak..." value="{{ old('organizer', $c?->organizer) }}" />
            <x-text-input name="location" label="Lokasyon (opsiyonel)" placeholder="Örn: İstanbul / Türkiye" value="{{ old('location', $c?->location) }}" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-text-input type="date" name="start_date" label="Başlangıç Tarihi (opsiyonel)" value="{{ old('start_date', optional($c?->start_date)->format('Y-m-d')) }}" />
            <x-text-input type="date" name="end_date" label="Bitiş Tarihi (opsiyonel)" value="{{ old('end_date', optional($c?->end_date)->format('Y-m-d')) }}" />
        </div>

        <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

        <x-textarea name="description" label="Açıklama (opsiyonel)" placeholder="Yarışma hakkında dahili notlar, kategoriler, ödüller..." rows="4">{{ old('description', $c?->description) }}</x-textarea>

        @isset($c)
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $c->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-slate-300 text-fuchsia-600 focus:ring-fuchsia-500">
                <span class="text-sm text-slate-600 dark:text-slate-300">Aktif</span>
            </label>
        @endisset
    </div>
</div>
