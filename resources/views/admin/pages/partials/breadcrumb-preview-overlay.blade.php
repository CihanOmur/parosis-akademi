{{-- Breadcrumb preview üstüne yerleştirilen "Arka plan rengi + Görsel" overlay. --}}
{{-- Section'ın içine ilk eleman olarak include edilmeli. --}}
<div @click.stop style="position: absolute; top: 10px; left: 10px; z-index: 5; display: inline-flex; align-items: center; gap: 6px; padding: 4px 8px; background: rgba(255,255,255,0.95); border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); font-family: Inter, sans-serif; font-size: 11px;">
    {{-- Renk picker --}}
    <span style="color: #475569; font-weight: 500;">Arka plan:</span>
    <input type="color" :value="fields.breadcrumb_bg_color || '#FAF9F6'"
           @input="fields.breadcrumb_bg_color = $event.target.value"
           style="width: 26px; height: 22px; padding: 0; border: 1px solid #cbd5e1; border-radius: 4px; cursor: pointer; background: transparent;">
    <button type="button" @click="fields.breadcrumb_bg_color = ''" title="Rengi sıfırla"
            style="border: none; background: transparent; cursor: pointer; color: #94a3b8; font-size: 14px; padding: 0 4px;">↺</button>

    {{-- Separator --}}
    <span style="width: 1px; height: 18px; background: #cbd5e1;"></span>

    {{-- Görsel butonu --}}
    <button type="button"
            @click="openModal('breadcrumb_bg_image', 'Ust Bolum Arka Plan Gorseli', 'image')"
            style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border: none; border-radius: 4px; cursor: pointer; color: white; background: #0ea5e9; font-size: 11px; font-weight: 600;">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159M2.25 15.75v3a1.5 1.5 0 0 0 1.5 1.5h16.5a1.5 1.5 0 0 0 1.5-1.5v-3M15.75 8.25h.008v.008h-.008V8.25Z"/></svg>
        <span x-text="fields.breadcrumb_bg_image ? 'Değiştir' : 'Görsel'"></span>
    </button>

    <template x-if="fields.breadcrumb_bg_image">
        <button type="button" @click="fields.breadcrumb_bg_image = ''" title="Görseli kaldır"
                style="border: none; background: #fee2e2; color: #b91c1c; cursor: pointer; font-size: 11px; padding: 2px 6px; border-radius: 4px; font-weight: 600;">✕</button>
    </template>
</div>
