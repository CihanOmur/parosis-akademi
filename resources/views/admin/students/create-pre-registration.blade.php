@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('students.pre.students') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Ön Kayıt Ekle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Yeni bir ön kayıt oluşturun</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('students.pre.storePreRegistiration') }}" method="POST" enctype="multipart/form-data"
      x-data="{
          studentName: @js(old('full_name', '')),
          meetsStatus: @js(old('meets_status', 'Görüşülecek')),
          get initials() {
              const parts = this.studentName.trim().split(' ').filter(Boolean);
              if (parts.length >= 2) return (parts[0][0] + parts[parts.length-1][0]).toUpperCase();
              if (parts.length === 1) return parts[0].slice(0,2).toUpperCase();
              return '??';
          }
      }">
    @csrf
    <input type="hidden" name="registiration_type" value="1">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Öğrenci Bilgileri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Öğrenci Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Öğrencinin temel bilgilerini girin</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Ad Soyad --}}
                        <x-text-input
                            name="full_name"
                            label="Ad Soyad"
                            placeholder="Örn: Ahmet Yılmaz"
                            :required="true"
                            ringColor="blue"
                            icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>'
                            x-model="studentName"
                        />

                        {{-- Doğum Tarihi --}}
                        <x-text-input
                            name="birth_date"
                            type="date"
                            label="Doğum Tarihi"
                            :required="true"
                            ringColor="blue"
                            icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>'
                        />
                    </div>
                </div>
            </div>

            {{-- Veli Bilgileri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Veli Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Öğrenci velisinin iletişim bilgileri</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Yakınlık --}}
                        <x-text-input
                            name="guardian1_relationship"
                            label="Yakınlık"
                            placeholder="Örn: Anne"
                            :required="true"
                            ringColor="violet"
                        />

                        {{-- Ad Soyad --}}
                        <x-text-input
                            name="guardian1_full_name"
                            label="Ad Soyad"
                            placeholder="Örn: Ayşe Yılmaz"
                            :required="true"
                            ringColor="violet"
                        />

                        {{-- Telefon 1 --}}
                        <x-text-input
                            name="guardian1_phone_1"
                            type="tel"
                            label="Telefon"
                            placeholder="05XX XXX XX XX"
                            :required="true"
                            ringColor="violet"
                            icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>'
                            inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                        />

                        {{-- Telefon 2 --}}
                        <x-text-input
                            name="guardian1_phone_2"
                            type="tel"
                            label="Telefon 2"
                            placeholder="05XX XXX XX XX"
                            ringColor="violet"
                            icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>'
                            inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                        />
                    </div>
                </div>
            </div>

            {{-- Randevu & Notlar --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Randevu & Notlar</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Görüşme durumu ve ek notlar</p>
                    </div>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Randevu Durumu --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Randevu Durumu
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            {{-- Görüşülecek --}}
                            <label class="relative cursor-pointer" @click="meetsStatus = 'Görüşülecek'">
                                <input type="radio" name="meets_status" value="Görüşülecek" x-model="meetsStatus" class="sr-only">
                                <div class="flex items-center gap-2 px-4 py-3 rounded-xl border-2 transition-all"
                                     :class="meetsStatus === 'Görüşülecek'
                                         ? 'border-amber-400 bg-amber-50 dark:bg-amber-900/20'
                                         : 'border-slate-200 dark:border-slate-600 hover:border-slate-300 dark:hover:border-slate-500'">
                                    <svg class="w-4.5 h-4.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <span class="text-sm font-medium" :class="meetsStatus === 'Görüşülecek' ? 'text-amber-700 dark:text-amber-300' : 'text-slate-700 dark:text-slate-300'">Görüşülecek</span>
                                </div>
                            </label>

                            {{-- Görüşüldü --}}
                            <label class="relative cursor-pointer" @click="meetsStatus = 'Görüşüldü'">
                                <input type="radio" name="meets_status" value="Görüşüldü" x-model="meetsStatus" class="sr-only">
                                <div class="flex items-center gap-2 px-4 py-3 rounded-xl border-2 transition-all"
                                     :class="meetsStatus === 'Görüşüldü'
                                         ? 'border-emerald-400 bg-emerald-50 dark:bg-emerald-900/20'
                                         : 'border-slate-200 dark:border-slate-600 hover:border-slate-300 dark:hover:border-slate-500'">
                                    <svg class="w-4.5 h-4.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <span class="text-sm font-medium" :class="meetsStatus === 'Görüşüldü' ? 'text-emerald-700 dark:text-emerald-300' : 'text-slate-700 dark:text-slate-300'">Görüşüldü</span>
                                </div>
                            </label>

                            {{-- Görüşülmedi --}}
                            <label class="relative cursor-pointer" @click="meetsStatus = 'Görüşülmedi'">
                                <input type="radio" name="meets_status" value="Görüşülmedi" x-model="meetsStatus" class="sr-only">
                                <div class="flex items-center gap-2 px-4 py-3 rounded-xl border-2 transition-all"
                                     :class="meetsStatus === 'Görüşülmedi'
                                         ? 'border-red-400 bg-red-50 dark:bg-red-900/20'
                                         : 'border-slate-200 dark:border-slate-600 hover:border-slate-300 dark:hover:border-slate-500'">
                                    <svg class="w-4.5 h-4.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <span class="text-sm font-medium" :class="meetsStatus === 'Görüşülmedi' ? 'text-red-700 dark:text-red-300' : 'text-slate-700 dark:text-slate-300'">Görüşülmedi</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Notlar --}}
                    <div class="space-y-1">
                        <label for="notes" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Notlar <span class="text-slate-400 text-xs font-normal">(Opsiyonel)</span>
                        </label>
                        <textarea id="notes" name="notes" rows="4"
                                  placeholder="Ek bilgi veya notlarınızı yazın..."
                                  class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                         text-slate-900 dark:text-white placeholder-slate-400
                                         ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-amber-500/60 transition-all
                                         resize-none @error('notes') ring-red-400 focus:ring-red-500/60 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-sm text-red-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Sag kolon --}}
        <div class="space-y-4">

            {{-- Onizleme Karti --}}
            <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg shadow-amber-500/25">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center mb-4">
                    <span class="text-lg font-bold text-white" x-text="initials"></span>
                </div>
                <h4 class="text-lg font-bold leading-snug min-h-[1.75rem] mb-1" x-text="studentName || 'Öğrenci Adı'"></h4>
                <p class="text-white/60 text-xs mb-4">Ön Kayıt</p>
                <div class="pt-4 border-t border-white/20 space-y-2 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-white/70">Randevu</span>
                        <span class="font-bold text-xs px-2 py-0.5 rounded-lg bg-white/20" x-text="meetsStatus"></span>
                    </div>
                </div>
            </div>

            {{-- Islemler --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-sm p-5 space-y-3">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-3
                               bg-gradient-to-r from-fuchsia-500 to-purple-500
                               hover:from-fuchsia-600 hover:to-purple-600
                               text-white font-semibold rounded-xl
                               shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Ön Kaydı Oluştur
                </button>
                <a href="{{ route('students.pre.students') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-6 py-3
                          text-slate-600 dark:text-slate-400 font-medium rounded-xl
                          hover:bg-slate-50 dark:hover:bg-slate-700/50 border border-slate-200 dark:border-slate-700 transition-all">
                    İptal
                </a>
            </div>
        </div>
    </div>
</form>
@endsection
