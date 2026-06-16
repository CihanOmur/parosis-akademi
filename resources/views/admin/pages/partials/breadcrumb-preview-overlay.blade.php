{{-- Breadcrumb preview üstüne yerleştirilen "Arka plan rengi" overlay'i. --}}
{{-- Section'ın içine ilk eleman olarak include edilmeli. --}}
<div @click.stop style="position: absolute; top: 10px; left: 10px; z-index: 5; display: inline-flex; align-items: center; gap: 6px; padding: 4px 8px; background: rgba(255,255,255,0.95); border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); font-family: Inter, sans-serif; font-size: 11px;">
    <span style="color: #475569; font-weight: 500;">Arka plan rengi:</span>
    <input type="color" :value="fields.breadcrumb_bg_color || '#FAF9F6'"
           @input="fields.breadcrumb_bg_color = $event.target.value"
           style="width: 26px; height: 22px; padding: 0; border: 1px solid #cbd5e1; border-radius: 4px; cursor: pointer; background: transparent;">
    <button type="button" @click="fields.breadcrumb_bg_color = ''" title="Sıfırla"
            style="border: none; background: transparent; cursor: pointer; color: #94a3b8; font-size: 14px; padding: 0 4px;">↺</button>
    <template x-if="fields.breadcrumb_bg_image">
        <button type="button" @click="fields.breadcrumb_bg_image = ''" title="Görseli kaldır"
                style="border: none; background: #fee2e2; color: #b91c1c; cursor: pointer; font-size: 11px; padding: 2px 6px; border-radius: 4px; font-weight: 600;">✕ Görsel</button>
    </template>
</div>
