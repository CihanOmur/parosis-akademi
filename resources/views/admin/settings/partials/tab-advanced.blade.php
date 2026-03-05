<form method="POST" action="{{ route('settings.updateAdvanced') }}">
    @csrf

    {{-- Maintenance Mode --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-base font-semibold text-slate-900 dark:text-white">Bakım Modu</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Aktif olduğunda ziyaretçiler bakım sayfasını görür. Admin panele erişim etkilenmez.</p>
            </div>
            <label class="relative inline-flex cursor-pointer items-center">
                <input type="checkbox" name="maintenance_mode" value="1" class="peer sr-only"
                       {{ ($advanced['maintenance_mode'] ?? '0') === '1' ? 'checked' : '' }}>
                <div class="h-7 w-12 rounded-full bg-slate-200 after:absolute after:left-[3px] after:top-[3px] after:h-[22px] after:w-[22px] after:rounded-full after:bg-white after:shadow-sm after:transition-all after:content-[''] peer-checked:bg-fuchsia-500 peer-checked:after:translate-x-5 dark:bg-slate-700"></div>
            </label>
        </div>

        @if(($advanced['maintenance_mode'] ?? '0') === '1')
        <div class="mt-4 rounded-xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 p-4">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                <p class="text-sm font-medium text-amber-800 dark:text-amber-200">Bakım modu aktif! Ziyaretçiler siteye erişemiyor.</p>
            </div>
        </div>
        @endif
    </div>

    {{-- Custom Head Code --}}
    <div class="mt-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
        <h2 class="text-base font-semibold text-slate-900 dark:text-white mb-1">Özel Head Kodu</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">&lt;head&gt; etiketinin sonuna eklenir. CSS, meta tag'ler, üçüncü parti scriptler vb.</p>
        <x-textarea name="custom_head_code" :value="$advanced['custom_head_code'] ?? ''" :rows="6" placeholder="<!-- Özel head kodunuz -->" input-class="font-mono" />
    </div>

    {{-- Custom Body Code --}}
    <div class="mt-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
        <h2 class="text-base font-semibold text-slate-900 dark:text-white mb-1">Özel Body Kodu</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">&lt;/body&gt; etiketinden hemen önce eklenir. Chat widget'ları, analitik vb.</p>
        <x-textarea name="custom_body_code" :value="$advanced['custom_body_code'] ?? ''" :rows="6" placeholder="<!-- Özel body kodunuz -->" input-class="font-mono" />
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            Kaydet
        </button>
    </div>
</form>
