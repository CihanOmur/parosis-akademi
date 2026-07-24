@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">SSS Yönetimi</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sıkça sorulan soruları yönetin</p>
    </div>
    <a href="{{ route('faq.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Yeni Soru Ekle
    </a>
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="w-10 px-3 py-4"></th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Soru</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">Durum</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-48">İşlem</th>
                    </tr>
                </thead>
                <tbody id="sortable-body" class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($faqs as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors" data-id="{{ $item->id }}" id="row-{{ $item->id }}">
                            <td class="px-3 py-4 cursor-grab active:cursor-grabbing sortable-handle">
                                <svg class="w-5 h-5 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('faq.edit', $item->id) }}"
                                   class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                    {{ $item->question }}
                                </a>
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
                                <x-action-menu>
                                    <a href="{{ route('faq.edit', $item->id) }}" class="am-item">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/></svg>
                                        Düzenle
                                    </a>
                                    @foreach ($activeLanguages as $activeLang)
                                        <a href="{{ route('faq.editTranslate', ['id' => $item->id, 'lang' => $activeLang->locale]) }}" class="am-item">
                                            <span class="w-4 h-4 rounded flex items-center justify-center text-[9px] font-bold bg-slate-100 dark:bg-slate-700 text-slate-500">{{ strtoupper(substr($activeLang->locale, 0, 2)) }}</span>
                                            {{ $activeLang->name ?: $activeLang->locale }}
                                        </a>
                                    @endforeach
                                    <div class="am-divider"></div>
                                    <form action="{{ route('faq.delete', $item->id) }}" method="POST"
                                          x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Soruyu Sil', message: 'Bu SSS maddesini silmek istediğinize emin misiniz?', form: $el })" class="am-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="am-item am-danger">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                            Sil
                                        </button>
                                    </form>
                                </x-action-menu>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz SSS maddesi eklenmemiş.</p>
                                    <a href="{{ route('faq.create') }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline text-sm font-medium">
                                        İlk soruyu ekleyin
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    // Sürükle & Bırak Sıralama
    const sortableBody = document.getElementById('sortable-body');
    if (sortableBody) {
        Sortable.create(sortableBody, {
            delay: 600,
            delayOnTouchOnly: true,
            touchStartThreshold: 5,
            handle: '.sortable-handle',
            animation: 150,
            ghostClass: 'bg-fuchsia-50',
            chosenClass: 'shadow-lg',
            onEnd: function () {
                const order = Array.from(sortableBody.querySelectorAll('tr[data-id]'))
                    .map(function (row) { return parseInt(row.dataset.id); });

                axios.post('{{ route("faq.updateOrder") }}', {
                    order: order,
                    _token: csrfToken
                })
                .then(function (response) {
                    if (response.data.status === 1) {
                        showToast('success', response.data.message);
                    }
                })
                .catch(function () {
                    showToast('error', 'Sıralama güncellenirken bir hata oluştu.');
                });
            }
        });
    }

    // Aktif / Pasif toggle
    document.querySelectorAll('.status-toggle').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const itemId    = this.dataset.id;
            const label     = document.getElementById('status-label' + itemId);
            const prevState = !this.checked;
            const self      = this;

            axios.post('/panel/faq/' + itemId + '/toggle', { _token: csrfToken })
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
</script>
@endsection
