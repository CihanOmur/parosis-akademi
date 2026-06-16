{{-- Breadcrumb preview üstüne yerleştirilen "Arka plan rengi + Görsel" overlay. --}}
{{-- Section'ın içine ilk eleman olarak include edilmeli. --}}
<style>
    .bc-overlay-bar {
        position: absolute !important; top: 12px !important; left: 12px !important; z-index: 50 !important;
        display: inline-flex !important; align-items: center !important; gap: 8px !important;
        padding: 6px 10px !important;
        background: #ffffff !important; border: 1px solid #cbd5e1 !important; border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        font-family: Inter, sans-serif !important; font-size: 12px !important; line-height: 1 !important;
    }
    .bc-overlay-bar .bc-lbl { color: #475569 !important; font-weight: 600 !important; }
    .bc-overlay-bar input[type="color"] {
        width: 28px !important; height: 24px !important; padding: 0 !important;
        border: 1px solid #cbd5e1 !important; border-radius: 4px !important;
        cursor: pointer !important; background: transparent !important;
    }
    .bc-overlay-bar .bc-icon-btn {
        display: inline-flex !important; align-items: center !important; justify-content: center !important;
        width: 24px !important; height: 24px !important; padding: 0 !important;
        border: 1px solid transparent !important; border-radius: 4px !important;
        background: transparent !important; color: #64748b !important; cursor: pointer !important;
        font-size: 14px !important;
    }
    .bc-overlay-bar .bc-icon-btn:hover { background: #f1f5f9 !important; color: #0f172a !important; }
    .bc-overlay-bar .bc-sep {
        display: inline-block !important; width: 1px !important; height: 20px !important; background: #cbd5e1 !important;
    }
    .bc-overlay-bar .bc-img-btn {
        display: inline-flex !important; align-items: center !important; gap: 6px !important;
        padding: 6px 12px !important;
        border: none !important; border-radius: 6px !important;
        background: #0ea5e9 !important; color: #ffffff !important;
        cursor: pointer !important; font-size: 12px !important; font-weight: 700 !important;
    }
    .bc-overlay-bar .bc-img-btn:hover { background: #0284c7 !important; }
    .bc-overlay-bar .bc-rm-btn {
        display: inline-flex !important; align-items: center !important;
        padding: 4px 8px !important; border: none !important; border-radius: 4px !important;
        background: #fee2e2 !important; color: #b91c1c !important;
        cursor: pointer !important; font-size: 12px !important; font-weight: 700 !important;
    }
</style>

<div @click.stop class="bc-overlay-bar">
    <span class="bc-lbl">Arka plan:</span>

    <input type="color" :value="fields.breadcrumb_bg_color || '#FAF9F6'"
           @input="fields.breadcrumb_bg_color = $event.target.value">

    <button type="button" class="bc-icon-btn" @click="fields.breadcrumb_bg_color = ''" title="Rengi sıfırla">↺</button>

    <span class="bc-sep"></span>

    <button type="button" class="bc-img-btn"
            @click="openModal('breadcrumb_bg_image', 'Ust Bolum Arka Plan Gorseli', 'image')">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159M2.25 15.75v3a1.5 1.5 0 0 0 1.5 1.5h16.5a1.5 1.5 0 0 0 1.5-1.5v-3M15.75 8.25h.008v.008h-.008V8.25Z"/></svg>
        <span x-text="fields.breadcrumb_bg_image ? 'Görseli Değiştir' : 'Görsel Yükle'"></span>
    </button>

    <template x-if="fields.breadcrumb_bg_image">
        <button type="button" class="bc-rm-btn"
                @click="fields.breadcrumb_bg_image = ''" title="Görseli kaldır">✕ Kaldır</button>
    </template>
</div>
