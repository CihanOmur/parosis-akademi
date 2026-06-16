{{--
    Breadcrumb section için "Düzenle" butonu + Arka Plan Modal'ı.
    Section'ın hemen içine yerleştirilmeli.
    Ana Alpine scope'da gerekli alanlar: bgPopover, fields.breadcrumb_bg_color, fields.breadcrumb_bg_image, saveAll(), openModal(), baseUrl
--}}

{{-- Sağ üst Düzenle butonu (section içinde, position absolute) --}}
<div style="position: absolute; top: 12px; right: 12px; z-index: 50;">
    <button type="button" @click="bgPopover = true"
            style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #1e293b; color: #ffffff; border: none; border-radius: 6px; cursor: pointer; font-family: Inter, sans-serif; font-size: 12px; font-weight: 600; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/></svg>
        <span>Düzenle</span>
    </button>
</div>

{{-- Modal — position fixed, viewport'a göre konumlanır, overflow:hidden'den etkilenmez --}}
<div x-show="bgPopover" x-cloak
     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;"
     @keydown.escape.window="bgPopover = false">
    <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="bgPopover = false"></div>
    <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
        <div x-show="bgPopover"
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
             style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 540px; overflow: hidden; display: flex; flex-direction: column;"
             @click.stop>

            {{-- Header --}}
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgb(1 28 26 / 0.06); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 36px; height: 36px; background: rgb(84 62 232); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 18px; height: 18px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15"/></svg>
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: rgb(1 28 26); font-family: 'Aeonik Pro TRIAL', sans-serif;">Üst Bölüm Arka Planı</h3>
                </div>
                <button type="button" @click="bgPopover = false"
                        style="background: rgb(1 28 26 / 0.04); border: none; border-radius: 8px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: rgb(1 28 26);">
                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Body --}}
            <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1.5rem;">
                {{-- Renk --}}
                <div>
                    <label style="display: block; font-size: 0.875rem; color: rgb(1 28 26 / 0.7); font-weight: 600; margin-bottom: 0.625rem; font-family: 'Aeonik Pro TRIAL', sans-serif;">Arka Plan Rengi</label>
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <input type="color" :value="fields.breadcrumb_bg_color || '#FAF9F6'"
                               @input="fields.breadcrumb_bg_color = $event.target.value"
                               @change="saveAll()"
                               style="width: 48px; height: 40px; padding: 0; border: 1px solid rgb(1 28 26 / 0.1); border-radius: 8px; cursor: pointer; background: transparent;">
                        <input type="text" x-model="fields.breadcrumb_bg_color" placeholder="#FAF9F6"
                               @change="saveAll()"
                               style="flex: 1; padding: 0.5rem 0.875rem; border: 1px solid rgb(1 28 26 / 0.1); border-radius: 8px; font-family: monospace; font-size: 0.875rem; color: rgb(1 28 26);">
                        <button type="button" @click="fields.breadcrumb_bg_color = ''; saveAll()" title="Sıfırla"
                                style="width: 40px; height: 40px; border: 1px solid rgb(1 28 26 / 0.1); background: rgb(1 28 26 / 0.04); border-radius: 8px; cursor: pointer; color: rgb(1 28 26 / 0.7); font-size: 1rem;">↺</button>
                    </div>
                </div>

                {{-- Görsel --}}
                <div>
                    <label style="display: block; font-size: 0.875rem; color: rgb(1 28 26 / 0.7); font-weight: 600; margin-bottom: 0.625rem; font-family: 'Aeonik Pro TRIAL', sans-serif;">Arka Plan Görseli</label>
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <button type="button"
                                @click="bgPopover = false; openModal('breadcrumb_bg_image', 'Ust Bolum Arka Plan Gorseli', 'image')"
                                style="flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.625rem 1rem; background: rgb(84 62 232); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 0.875rem; font-weight: 600;">
                            <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159M2.25 15.75v3a1.5 1.5 0 0 0 1.5 1.5h16.5a1.5 1.5 0 0 0 1.5-1.5v-3M15.75 8.25h.008v.008h-.008V8.25Z"/></svg>
                            <span x-text="fields.breadcrumb_bg_image ? 'Görseli Değiştir' : 'Görsel Yükle'"></span>
                        </button>
                        <template x-if="fields.breadcrumb_bg_image">
                            <button type="button" @click="fields.breadcrumb_bg_image = ''; saveAll()"
                                    style="padding: 0.625rem 1rem; background: rgb(215 59 62 / 0.1); color: rgb(215 59 62); border: none; border-radius: 8px; cursor: pointer; font-size: 0.875rem; font-weight: 600;">Kaldır</button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: flex-end; gap: 0.625rem;">
                <button type="button" @click="bgPopover = false"
                        style="padding: 0.5rem 1.25rem; background: rgb(84 62 232); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 0.875rem; font-weight: 600;">Tamam</button>
            </div>
        </div>
    </div>
</div>
