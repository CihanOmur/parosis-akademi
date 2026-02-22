@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kullanıcılar</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sistem kullanıcılarını yönetin</p>
    </div>
    @can('user')
        <a href="{{ route('users.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3
                  bg-gradient-to-r from-fuchsia-500 to-purple-500
                  hover:from-fuchsia-600 hover:to-purple-600
                  text-white font-semibold rounded-xl
                  shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Yeni Kullanıcı
        </a>
    @endcan
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50 [&>tr>th:first-child]:rounded-tl-2xl [&>tr>th:last-child]:rounded-tr-2xl">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kullanıcı</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">E-posta</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Rol</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($users as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            {{-- Kullanıcı --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-400 to-purple-500
                                                flex items-center justify-center flex-shrink-0 shadow-sm">
                                        <span class="text-xs font-bold text-white uppercase">
                                            {{ strtoupper(substr($item->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <a href="{{ route('users.edit', $item->id) }}"
                                       class="font-semibold text-fuchsia-600 dark:text-fuchsia-400 hover:text-fuchsia-800 dark:hover:text-fuchsia-300 transition-colors">
                                        {{ $item->name }}
                                    </a>
                                </div>
                            </td>

                            {{-- E-posta --}}
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                {{ $item->email }}
                            </td>

                            {{-- Rol --}}
                            <td class="px-6 py-4">
                                @forelse ($item->roles as $role)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                                                 bg-violet-100 dark:bg-violet-900/30 text-violet-700 dark:text-violet-300
                                                 border border-violet-200/60 dark:border-violet-700/40 mr-1">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-slate-400 dark:text-slate-500 italic">Rol atanmamış</span>
                                @endforelse
                            </td>

                            {{-- İşlem --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    @can('user')
                                        <a href="{{ route('users.edit', $item->id) }}"
                                           class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                                  hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all"
                                           title="Düzenle">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                            </svg>
                                        </a>
                                    @endcan

                                    @can('user_delete')
                                        <form action="{{ route('users.delete', $item->id) }}" method="POST"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', {
                                                  title: 'Kullanıcıyı Sil',
                                                  message: '{{ addslashes($item->name) }} adlı kullanıcıyı silmek istediğinize emin misiniz?',
                                                  form: $el
                                              })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50
                                                           dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer"
                                                    title="Sil">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz kullanıcı eklenmemiş.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
@endsection
