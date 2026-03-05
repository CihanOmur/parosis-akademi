<form method="POST" action="{{ route('settings.updateLogos') }}" enctype="multipart/form-data">
    @csrf
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
        <h2 class="text-base font-semibold text-slate-900 dark:text-white mb-6">Logo Ayarları</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ([
                ['key' => 'header_logo', 'label' => 'Header Logo', 'hint' => 'PNG, JPG, SVG, WEBP &bull; Maks. 2MB', 'accept' => 'image/png,image/jpeg,image/webp,image/svg+xml'],
                ['key' => 'footer_logo', 'label' => 'Footer Logo', 'hint' => 'PNG, JPG, SVG, WEBP &bull; Maks. 2MB', 'accept' => 'image/png,image/jpeg,image/webp,image/svg+xml'],
                ['key' => 'favicon',     'label' => 'Favicon',     'hint' => 'PNG, ICO, SVG &bull; Maks. 512KB',     'accept' => 'image/png,image/x-icon,image/svg+xml'],
                ['key' => 'admin_logo',  'label' => 'Admin Logo',  'hint' => 'PNG, JPG, SVG, WEBP &bull; Maks. 2MB', 'accept' => 'image/png,image/jpeg,image/webp,image/svg+xml'],
            ] as $logo)
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ $logo['label'] }}</label>
                <x-image-upload
                    :name="$logo['key']"
                    :existing="!empty($logos[$logo['key']]) ? asset($logos[$logo['key']]) : null"
                    :hint="$logo['hint']"
                    :accept="$logo['accept']"
                    :label="$logo['label'] . ' yüklemek için tıklayın'"
                />
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            Kaydet
        </button>
    </div>
</form>
