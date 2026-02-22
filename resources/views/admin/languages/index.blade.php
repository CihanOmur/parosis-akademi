@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Diller</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Desteklenen dilleri yönetin</p>
    </div>
    <a href="{{ route('languages.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Yeni Dil Ekle
    </a>
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50 [&>tr>th:first-child]:rounded-tl-2xl [&>tr>th:last-child]:rounded-tr-2xl">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Dil Adı</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Locale</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Varsayılan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Frontend</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($languages as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors" id="row-{{ $item->id }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 border
                                                {{ $item->is_default
                                                    ? 'bg-amber-50 dark:bg-amber-900/20 border-amber-200/60 dark:border-amber-700/40'
                                                    : 'bg-fuchsia-50 dark:bg-fuchsia-900/20 border-fuchsia-200/50 dark:border-fuchsia-700/30' }}">
                                        <span class="text-xs font-bold uppercase
                                                     {{ $item->is_default ? 'text-amber-600 dark:text-amber-400' : 'text-fuchsia-600 dark:text-fuchsia-400' }}">
                                            {{ strtoupper(substr($item->locale, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <a href="{{ route('languages.edit', $item->id) }}"
                                           class="font-semibold transition-colors
                                                  {{ $item->is_default ? 'text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300' : 'text-fuchsia-600 dark:text-fuchsia-400 hover:text-fuchsia-800 dark:hover:text-fuchsia-300' }}">
                                            {{ $item->name ?: $item->locale }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono text-xs px-2.5 py-1.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-lg">{{ $item->locale }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->is_default)
                                    <span id="default-badge-{{ $item->id }}"
                                          class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold
                                                 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400
                                                 border border-amber-200/60 dark:border-amber-700/40">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                        </svg>
                                        Varsayılan
                                    </span>
                                @else
                                    <button type="button"
                                            id="default-badge-{{ $item->id }}"
                                            onclick="setDefault({{ $item->id }}, this)"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium cursor-pointer transition-all
                                                   text-slate-400 dark:text-slate-500 hover:text-amber-600 dark:hover:text-amber-400
                                                   hover:bg-amber-50 dark:hover:bg-amber-900/20 border border-transparent hover:border-amber-200/60 dark:hover:border-amber-700/40">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                        </svg>
                                        Varsayılan Yap
                                    </button>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <label class="inline-flex items-center gap-2.5 cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" class="sr-only peer status-toggle" data-id="{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full transition-colors duration-200"></div>
                                    </div>
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300" id="status-label{{ $item->id }}">
                                        {{ $item->is_active ? 'Aktif' : 'Pasif' }}
                                    </span>
                                </label>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('languages.edit', $item->id) }}"
                                       class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all" title="Düzenle">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                        </svg>
                                    </a>
                                    @if(!$item->is_default)
                                        <form action="{{ route('languages.delete', $item->id) }}" method="POST"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Dili Sil', message: 'Bu dili silmek istediğinize emin misiniz?', form: $el })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer" title="Sil">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        {{-- Varsayılan dil silinemez --}}
                                        <span class="p-2 text-slate-200 dark:text-slate-700 cursor-not-allowed rounded-lg" title="Varsayılan dil silinemez">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <p class="text-slate-500 dark:text-slate-400">Henüz dil eklenmemiş.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $languages->links() }}
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    // ── Aktif / Pasif toggle ──────────────────────────────────────────────────
    document.querySelectorAll('.status-toggle').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const itemId    = this.dataset.id;
            const label     = document.getElementById('status-label' + itemId);
            const prevState = !this.checked;
            const self      = this;

            axios.post('{{ route('languages.toggle') }}', { id: itemId, _token: csrfToken })
            .then(function (response) {
                if (response.data.status === 1) {
                    showToast('success', response.data.message);
                    if (label) label.textContent = response.data.action;
                } else {
                    showToast('error', response.data.message);
                    self.checked = prevState;
                }
            })
            .catch(function () {
                showToast('error', 'Bir hata oluştu.');
                self.checked = prevState;
            });
        });
    });

    // ── Varsayılan Dil ───────────────────────────────────────────────────────
    function setDefault(id, btn) {
        btn.disabled = true;

        axios.post('{{ route('languages.setDefault') }}', { id: id, _token: csrfToken })
        .then(function (response) {
            if (response.data.status === 1) {
                showToast('success', response.data.message);

                // Tüm varsayılan badge'leri "Varsayılan Yap" butonuna çevir
                document.querySelectorAll('[id^="default-badge-"]').forEach(function (el) {
                    const elId = parseInt(el.id.replace('default-badge-', ''));
                    if (elId === id) {
                        // Bu satır yeni varsayılan → badge göster
                        el.outerHTML = `
                            <span id="default-badge-${id}"
                                  class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold
                                         bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400
                                         border border-amber-200/60 dark:border-amber-700/40">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                </svg>
                                Varsayılan
                            </span>`;
                    } else {
                        // Diğerleri → "Varsayılan Yap" butonuna çevir
                        el.outerHTML = `
                            <button type="button" id="default-badge-${elId}"
                                    onclick="setDefault(${elId}, this)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium cursor-pointer transition-all
                                           text-slate-400 dark:text-slate-500 hover:text-amber-600 dark:hover:text-amber-400
                                           hover:bg-amber-50 dark:hover:bg-amber-900/20 border border-transparent hover:border-amber-200/60 dark:hover:border-amber-700/40">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                </svg>
                                Varsayılan Yap
                            </button>`;
                    }
                });

                // Silme butonunu da güncelle (varsayılan silinemez)
                // Sayfayı yenile ki satır renkleri de güncellensin
                setTimeout(() => location.reload(), 800);
            } else {
                showToast('error', response.data.message ?? 'Bir hata oluştu.');
                btn.disabled = false;
            }
        })
        .catch(function () {
            showToast('error', 'Bir hata oluştu.');
            btn.disabled = false;
        });
    }
</script>
@endsection
