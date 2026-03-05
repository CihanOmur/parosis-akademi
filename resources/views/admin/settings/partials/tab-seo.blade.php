<form method="POST" action="{{ route('settings.updateSeo') }}">
    @csrf
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
        <h2 class="text-base font-semibold text-slate-900 dark:text-white mb-6">SEO Ayarları</h2>
        <div class="grid grid-cols-1 gap-6">
            <x-text-input name="meta_title" label="Meta Başlık" :value="$seo['meta_title'] ?? ''" maxlength="70" />
            <div x-data="{ charCount: '{{ strlen($seo['meta_description'] ?? '') }}' }">
                <x-textarea name="meta_description" label="Meta Açıklama" :value="$seo['meta_description'] ?? ''" :rows="3" maxlength="160" x-on:input="charCount = $event.target.value.length" />
                <p class="mt-1 text-xs text-slate-400"><span x-text="charCount"></span>/160 karakter</p>
            </div>
            <x-text-input name="meta_keywords" label="Meta Anahtar Kelimeler" :value="$seo['meta_keywords'] ?? ''" placeholder="eğitim, akademi, kurs, online" />
        </div>
    </div>

    {{-- Analitik & İzleme --}}
    <div class="mt-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
        <h2 class="text-base font-semibold text-slate-900 dark:text-white mb-6">Analitik & İzleme</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="google_analytics_id" label="Google Analytics ID" :value="$seo['google_analytics_id'] ?? ''" placeholder="G-XXXXXXXXXX" />
            <x-text-input name="google_tag_manager_id" label="Google Tag Manager ID" :value="$seo['google_tag_manager_id'] ?? ''" placeholder="GTM-XXXXXX" />
            <div class="md:col-span-2">
                <x-text-input name="sitemap_url" label="Sitemap URL" :value="$seo['sitemap_url'] ?? ''" placeholder="/sitemap.xml" />
                <p class="mt-1 text-xs text-slate-400">Sitemap dosyasının yolu. robots.txt içine otomatik eklenir. Ör: /sitemap.xml</p>
            </div>
            <div class="md:col-span-2">
                <x-textarea name="robots_txt" label="robots.txt" :value="$seo['robots_txt'] ?? 'User-agent: *\nAllow: /'" :rows="6" input-class="font-mono" />
                <p class="mt-1 text-xs text-slate-400">Arama motoru botlarının site taramasını kontrol eder. <code class="text-fuchsia-500">/robots.txt</code> adresinden sunulur.</p>
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

{{-- Sitemap Özel Girişleri --}}
<div class="mt-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6"
     x-data="sitemapEntries()">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-base font-semibold text-slate-900 dark:text-white">Sitemap Girişleri</h2>
            <p class="mt-1 text-xs text-slate-400">Sitemap dosyasına eklemek istediğiniz özel URL'leri yönetin</p>
        </div>
        <button type="button" @click="openAdd()"
                class="inline-flex items-center gap-2 px-4 py-2 bg-fuchsia-500 hover:bg-fuchsia-600 text-white text-sm font-medium rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Yeni Ekle
        </button>
    </div>

    {{-- Entries Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm" x-show="entries.length > 0">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-700">
                    <th class="text-left py-3 px-3 font-medium text-slate-500 dark:text-slate-400">URL</th>
                    <th class="text-center py-3 px-3 font-medium text-slate-500 dark:text-slate-400 w-32">Sıklık</th>
                    <th class="text-center py-3 px-3 font-medium text-slate-500 dark:text-slate-400 w-24">Öncelik</th>
                    <th class="text-center py-3 px-3 font-medium text-slate-500 dark:text-slate-400 w-20">Durum</th>
                    <th class="text-center py-3 px-3 font-medium text-slate-500 dark:text-slate-400 w-28">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="entry in entries" :key="entry.id">
                    <tr class="border-b border-slate-100 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                        <td class="py-3 px-3">
                            <span class="text-slate-900 dark:text-white text-sm break-all" x-text="entry.loc"></span>
                        </td>
                        <td class="py-3 px-3 text-center">
                            <span class="text-slate-600 dark:text-slate-300 text-xs" x-text="entry.changefreq"></span>
                        </td>
                        <td class="py-3 px-3 text-center">
                            <span class="text-slate-600 dark:text-slate-300 text-xs" x-text="entry.priority"></span>
                        </td>
                        <td class="py-3 px-3 text-center">
                            <button type="button" @click="toggleActive(entry)"
                                    :class="entry.is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-slate-100 text-slate-500 dark:bg-slate-700 dark:text-slate-400'"
                                    class="px-2 py-0.5 rounded-full text-xs font-medium transition">
                                <span x-text="entry.is_active ? 'Aktif' : 'Pasif'"></span>
                            </button>
                        </td>
                        <td class="py-3 px-3 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <button type="button" @click="openEdit(entry)" class="p-1.5 text-slate-400 hover:text-fuchsia-500 transition" title="Düzenle">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                                </button>
                                <button type="button" @click="deleteEntry(entry.id)" class="p-1.5 text-slate-400 hover:text-red-500 transition" title="Sil">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <div x-show="entries.length === 0" class="text-center py-8 text-slate-400 dark:text-slate-500">
            <svg class="w-10 h-10 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/></svg>
            <p class="text-sm">Henüz özel sitemap girişi eklenmemiş</p>
        </div>
    </div>

    {{-- Add/Edit Modal --}}
    <div x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" @click.self="showModal = false">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg mx-4 p-6" @click.stop>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4" x-text="editingId ? 'Girişi Düzenle' : 'Yeni Giriş Ekle'"></h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">URL</label>
                    <input type="url" x-model="form.loc" placeholder="https://example.com/sayfa"
                           class="w-full rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:border-fuchsia-500 focus:ring-2 focus:ring-fuchsia-500/10 outline-none transition">
                    <p class="mt-1 text-xs text-red-500" x-show="formError" x-text="formError"></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Değişiklik Sıklığı</label>
                        <select x-model="form.changefreq"
                                class="w-full rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:border-fuchsia-500 focus:ring-2 focus:ring-fuchsia-500/10 outline-none transition">
                            <option value="always">always</option>
                            <option value="hourly">hourly</option>
                            <option value="daily">daily</option>
                            <option value="weekly">weekly</option>
                            <option value="monthly">monthly</option>
                            <option value="yearly">yearly</option>
                            <option value="never">never</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Öncelik</label>
                        <select x-model="form.priority"
                                class="w-full rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm text-slate-900 dark:text-white focus:border-fuchsia-500 focus:ring-2 focus:ring-fuchsia-500/10 outline-none transition">
                            <option value="1.0">1.0</option>
                            <option value="0.9">0.9</option>
                            <option value="0.8">0.8</option>
                            <option value="0.7">0.7</option>
                            <option value="0.6">0.6</option>
                            <option value="0.5">0.5</option>
                            <option value="0.4">0.4</option>
                            <option value="0.3">0.3</option>
                            <option value="0.2">0.2</option>
                            <option value="0.1">0.1</option>
                            <option value="0.0">0.0</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" @click="showModal = false"
                        class="px-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition">
                    İptal
                </button>
                <button type="button" @click="save()" :disabled="saving"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-fuchsia-500 hover:bg-fuchsia-600 disabled:opacity-50 text-white text-sm font-medium rounded-xl transition">
                    <svg x-show="saving" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    <span x-text="editingId ? 'Güncelle' : 'Ekle'"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function sitemapEntries() {
    return {
        entries: @json($sitemapEntries ?? []),
        showModal: false,
        editingId: null,
        saving: false,
        formError: '',
        form: { loc: '', changefreq: 'monthly', priority: '0.5' },

        openAdd() {
            this.editingId = null;
            this.form = { loc: '', changefreq: 'monthly', priority: '0.5' };
            this.formError = '';
            this.showModal = true;
        },

        openEdit(entry) {
            this.editingId = entry.id;
            this.form = { loc: entry.loc, changefreq: entry.changefreq, priority: entry.priority };
            this.formError = '';
            this.showModal = true;
        },

        async save() {
            if (!this.form.loc.trim()) { this.formError = 'URL alanı zorunludur.'; return; }
            this.saving = true;
            this.formError = '';
            try {
                const url = this.editingId
                    ? '{{ route("settings.sitemapEntries.update", ":id") }}'.replace(':id', this.editingId)
                    : '{{ route("settings.sitemapEntries.store") }}';
                const method = this.editingId ? 'PUT' : 'POST';
                const res = await fetch(url, {
                    method, headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    body: JSON.stringify(this.form)
                });
                const data = await res.json();
                if (!res.ok) { this.formError = data.message || 'Bir hata oluştu.'; return; }
                if (this.editingId) {
                    const idx = this.entries.findIndex(e => e.id === this.editingId);
                    if (idx !== -1) this.entries[idx] = data;
                } else {
                    this.entries.push(data);
                }
                this.showModal = false;
            } catch (e) { this.formError = 'Bir hata oluştu.'; } finally { this.saving = false; }
        },

        async toggleActive(entry) {
            try {
                const res = await fetch('{{ route("settings.sitemapEntries.toggle", ":id") }}'.replace(':id', entry.id), {
                    method: 'PATCH', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                });
                if (res.ok) { entry.is_active = !entry.is_active; }
            } catch (e) {}
        },

        async deleteEntry(id) {
            if (!confirm('Bu girişi silmek istediğinize emin misiniz?')) return;
            try {
                const res = await fetch('{{ route("settings.sitemapEntries.destroy", ":id") }}'.replace(':id', id), {
                    method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                });
                if (res.ok) { this.entries = this.entries.filter(e => e.id !== id); }
            } catch (e) {}
        }
    };
}
</script>
