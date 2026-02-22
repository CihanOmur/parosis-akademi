@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Roller</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Tüm rolleri ve izinlerini yönetin</p>
    </div>
    @can('user')
        <a href="{{ route('roles.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3
                  bg-gradient-to-r from-fuchsia-500 to-purple-500
                  hover:from-fuchsia-600 hover:to-purple-600
                  text-white font-semibold rounded-xl
                  shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Yeni Rol Ekle
        </a>
    @endcan
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50
                              [&>tr>th:first-child]:rounded-tl-2xl
                              [&>tr>th:last-child]:rounded-tr-2xl">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Rol Adı
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            İzinler
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Kullanıcı Sayısı
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            İşlem
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($roles as $role)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            {{-- Rol Adı --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600
                                                flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($role->name, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-slate-900 dark:text-white">
                                        {{ $role->name }}
                                    </span>
                                </div>
                            </td>

                            {{-- İzinler --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse ($role->permissions as $permission)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                                                     bg-fuchsia-50 text-fuchsia-700
                                                     dark:bg-fuchsia-900/30 dark:text-fuchsia-400">
                                            {{ $permissionLabels[$permission->name] ?? $permission->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-slate-400 italic">Atanmış izin yok</span>
                                    @endforelse
                                </div>
                            </td>

                            {{-- Kullanıcı Sayısı --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                                             bg-slate-100 text-slate-600
                                             dark:bg-slate-700 dark:text-slate-300">
                                    {{ $role->users()->count() }} kullanıcı
                                </span>
                            </td>

                            {{-- İşlemler --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    @can('user')
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                                  hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                                  rounded-lg transition-all" title="Düzenle">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                            </svg>
                                        </a>

                                        <form action="{{ route('roles.delete', $role->id) }}" method="POST"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', {
                                                  title: 'Rolü Sil',
                                                  message: '{{ addslashes($role->name) }} rolünü silmek istediğinize emin misiniz?',
                                                  form: $el
                                              })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-slate-400 hover:text-red-600
                                                           hover:bg-red-50 dark:hover:bg-red-900/20
                                                           rounded-lg transition-all cursor-pointer" title="Sil">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
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
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz rol eklenmemiş.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $roles->links() }}
    </div>
@endsection
