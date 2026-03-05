<form method="POST" action="{{ route('settings.updateGeneral') }}">
    @csrf
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
        <h2 class="text-base font-semibold text-slate-900 dark:text-white mb-6">Genel Bilgiler</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <x-text-input name="site_name" label="Site Adı" :value="$general['site_name'] ?? ''" required />
            </div>
            <div class="md:col-span-2">
                <x-textarea name="site_description" label="Site Açıklaması" :value="$general['site_description'] ?? ''" :rows="2" />
            </div>
            <x-text-input name="site_phone" label="Telefon" :value="$general['site_phone'] ?? ''" placeholder="+90 5XX XXX XX XX" />
            <x-text-input name="site_email" label="E-posta" type="email" :value="$general['site_email'] ?? ''" placeholder="info@example.com" />
            <div class="md:col-span-2">
                <x-textarea name="site_address" label="Adres" :value="$general['site_address'] ?? ''" :rows="2" />
            </div>
            <x-text-input name="copyright_text" label="Copyright Metni" :value="$general['copyright_text'] ?? ''" />
            <div class="space-y-1">
                <label for="timezone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Saat Dilimi</label>
                <select name="timezone" id="timezone"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                    @foreach(['Europe/Istanbul', 'UTC', 'Europe/London', 'Europe/Berlin', 'America/New_York', 'Asia/Tokyo'] as $tz)
                        <option value="{{ $tz }}" {{ ($general['timezone'] ?? 'Europe/Istanbul') === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            Kaydet
        </button>
    </div>
</form>
