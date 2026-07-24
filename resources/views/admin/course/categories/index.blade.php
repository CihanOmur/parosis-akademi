@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kurs Kategorileri</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Kurs kategorilerini yönetin</p>
    </div>
    <a href="{{ route('courseCategories.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Yeni Kategori Ekle
    </a>
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="w-10 px-3 py-4"></th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-16">İkon</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ad</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">Durum</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-48">İşlem</th>
                    </tr>
                </thead>
                <tbody id="sortable-body" class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($categories as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors" data-id="{{ $item->id }}" id="row-{{ $item->id }}">
                            <td class="px-3 py-4 cursor-grab active:cursor-grabbing sortable-handle">
                                <svg class="w-5 h-5 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: {{ ($item->color ?? '#DE1EF9') . '1a' }}">
                                    @if($item->icon)
                                        <img src="{{ asset($item->icon) }}" alt="" class="w-5 h-5 object-contain">
                                    @else
                                        <svg class="w-5 h-5" style="color: {{ $item->color ?? '#DE1EF9' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>
                                        </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('courseCategories.edit', $item->id) }}"
                                   class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                    {{ $item->name }}
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
                                    <a href="{{ route('courseCategories.edit', $item->id) }}" class="am-item">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/></svg>
                                        Düzenle
                                    </a>
                                    @foreach ($activeLanguages as $activeLang)
                                        <a href="{{ route('courseCategories.editTranslate', ['id' => $item->id, 'lang' => $activeLang->locale]) }}" class="am-item">
                                            <span class="w-4 h-4 rounded flex items-center justify-center text-[9px] font-bold bg-slate-100 dark:bg-slate-700 text-slate-500">{{ strtoupper(substr($activeLang->locale, 0, 2)) }}</span>
                                            {{ $activeLang->name ?: $activeLang->locale }}
                                        </a>
                                    @endforeach
                                    <div class="am-divider"></div>
                                    <form action="{{ route('courseCategories.delete', $item->id) }}" method="POST"
                                          x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Kategoriyi Sil', message: 'Bu kurs kategorisini silmek istediğinize emin misiniz?', form: $el })" class="am-form">
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
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/>
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz kurs kategorisi eklenmemiş.</p>
                                    <a href="{{ route('courseCategories.create') }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline text-sm font-medium">
                                        İlk kategoriyi ekleyin
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

                axios.post('{{ route("courseCategories.updateOrder") }}', {
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

            axios.post('/panel/course-categories/' + itemId + '/toggle', { _token: csrfToken })
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
