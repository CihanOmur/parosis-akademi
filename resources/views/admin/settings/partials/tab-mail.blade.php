<form method="POST" action="{{ route('settings.updateMail') }}">
    @csrf
    <div x-data="{ mailer: '{{ $mail['mail_mailer'] ?? 'log' }}' }" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
        <h2 class="text-base font-semibold text-slate-900 dark:text-white mb-6">E-posta Ayarları</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Mailer --}}
            <div class="md:col-span-2 space-y-1">
                <label for="mail_mailer" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Posta Sürücüsü</label>
                <select name="mail_mailer" id="mail_mailer" x-model="mailer"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                    <option value="log">Log (Test — e-postalar log dosyasına yazılır)</option>
                    <option value="smtp">SMTP (Gerçek e-posta gönderimi)</option>
                </select>
            </div>

            {{-- SMTP Fields --}}
            <template x-if="mailer === 'smtp'">
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-text-input name="mail_host" label="SMTP Host" :value="$mail['mail_host'] ?? ''" placeholder="smtp.gmail.com" />
                    <x-text-input name="mail_port" label="Port" type="number" :value="$mail['mail_port'] ?? '587'" placeholder="587" />
                    <x-text-input name="mail_username" label="Kullanıcı Adı" :value="$mail['mail_username'] ?? ''" placeholder="user@gmail.com" />
                    <div x-data="{ showPw: false }" class="space-y-1">
                        <label for="mail_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Şifre</label>
                        <div class="relative">
                            <input :type="showPw ? 'text' : 'password'" name="mail_password" id="mail_password" value="" placeholder="{{ !empty($mail['mail_password']) ? '••••••••' : '' }}"
                                   class="w-full px-4 py-3 pr-10 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                            <button type="button" @click="showPw = !showPw" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <svg x-show="!showPw" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                <svg x-show="showPw" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                            </button>
                        </div>
                        <p class="text-xs text-slate-400">Boş bırakırsanız mevcut şifre korunur</p>
                    </div>
                    <div class="space-y-1">
                        <label for="mail_encryption" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Şifreleme</label>
                        <select name="mail_encryption" id="mail_encryption"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                            <option value="tls" {{ ($mail['mail_encryption'] ?? 'tls') === 'tls' ? 'selected' : '' }}>TLS</option>
                            <option value="ssl" {{ ($mail['mail_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                            <option value="" {{ ($mail['mail_encryption'] ?? 'tls') === '' ? 'selected' : '' }}>Yok</option>
                        </select>
                    </div>
                    <x-text-input name="mail_from_address" label="Gönderen Adres" type="email" :value="$mail['mail_from_address'] ?? ''" placeholder="noreply@example.com" />
                    <x-text-input name="mail_from_name" label="Gönderen İsim" :value="$mail['mail_from_name'] ?? ''" placeholder="Parosis Akademi" />
                </div>
            </template>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            Kaydet
        </button>
    </div>
</form>

{{-- Test Mail --}}
<div class="mt-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6">
    <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Test E-postası Gönder</h3>
    <form method="POST" action="{{ route('settings.testMail') }}" class="flex flex-col sm:flex-row gap-3">
        @csrf
        <div class="flex-1">
            <x-text-input name="test_email" type="email" placeholder="test@example.com" required />
        </div>
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-xl text-sm transition whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
            Gönder
        </button>
    </form>
    <p class="mt-2 text-xs text-slate-400">Önce ayarları kaydedin, sonra test edin.</p>
</div>
