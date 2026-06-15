@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Danışmanlık Kurumları</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sertifika düzenlerken seçilebilecek danışmanlık kurumlarını yönetin</p>
    </div>
    <a href="{{ route('consultingInstitutions.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Yeni Kurum Ekle
    </a>
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="w-10 px-3 py-4"></th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kurum Adı</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İletişim</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32 text-center">Sertifika</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">Durum</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32">İşlem</th>
                    </tr>
                </thead>
                <tbody id="sortable-body" class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($institutions as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors" data-id="{{ $item->id }}">
                            <td class="px-3 py-4 cursor-grab active:cursor-grabbing sortable-handle">
                                <svg class="w-5 h-5 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('consultingInstitutions.edit', $item->id) }}"
                                   class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                    {{ $item->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                                <div class="space-y-0.5">
                                    @if($item->contact_email)
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                                            </svg>
                                            <span>{{ $item->contact_email }}</span>
                                        </div>
                                    @endif
                                    @if($item->contact_phone)
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
                                            </svg>
                                            <span>{{ $item->contact_phone }}</span>
                                        </div>
                                    @endif
                                    @if(!$item->contact_email && !$item->contact_phone)
                                        <span class="text-xs italic">—</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->certificates_count > 0)
                                    <x-count-badge
                                        :count="$item->certificates_count"
                                        label="sertifika"
                                        :href="route('consultingInstitutions.show', $item->id)"
                                        color="fuchsia"
                                        title="Bu kurumun sertifikalarını listele">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    </x-count-badge>
                                @else
                                    <span class="text-xs italic text-slate-400 dark:text-slate-500">—</span>
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
                                    <a href="{{ route('consultingInstitutions.edit', $item->id) }}"
                                       class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all" title="Düzenle">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('consultingInstitutions.delete', $item->id) }}" method="POST"
                                          x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Kurumu Sil', message: '{{ addslashes($item->name) }} kurumunu silmek istediğinize emin misiniz?', form: $el })">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer" title="Sil">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz danışmanlık kurumu eklenmemiş.</p>
                                    <a href="{{ route('consultingInstitutions.create') }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline text-sm font-medium">
                                        İlk kurumu ekleyin
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

    const sortableBody = document.getElementById('sortable-body');
    if (sortableBody) {
        Sortable.create(sortableBody, {
            handle: '.sortable-handle',
            animation: 150,
            ghostClass: 'bg-fuchsia-50',
            chosenClass: 'shadow-lg',
            onEnd: function () {
                const order = Array.from(sortableBody.querySelectorAll('tr[data-id]'))
                    .map(function (row) { return parseInt(row.dataset.id); });
                axios.post('{{ route("consultingInstitutions.updateOrder") }}', { order: order, _token: csrfToken })
                    .then(function (r) { if (r.data.status === 1) showToast('success', r.data.message); })
                    .catch(function () { showToast('error', 'Sıralama güncellenirken bir hata oluştu.'); });
            }
        });
    }

    document.querySelectorAll('.status-toggle').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const id = this.dataset.id;
            const label = document.getElementById('status-label' + id);
            const prev = !this.checked;
            const self = this;
            axios.post('/panel/consulting-institutions/' + id + '/toggle', { _token: csrfToken })
                .then(function (r) {
                    if (r.data.status === 1) {
                        showToast('success', r.data.message);
                        if (label) label.textContent = r.data.action;
                    } else { showToast('error', r.data.message); self.checked = prev; }
                })
                .catch(function () { showToast('error', 'Bir hata oluştu.'); self.checked = prev; });
        });
    });
</script>
@endsection
