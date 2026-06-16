{{--
    Ana editör Alpine scope'unda olmalı:
      fields.breadcrumb_bg_color (string|null)
      fields.breadcrumb_bg_image (string|null)
      baseUrl
      openModal(field, label, type)
--}}
<style>
    .bcbg-wrap { padding: 0 1.25rem; margin: 0 auto 1rem; max-width: 1200px; }
    .bcbg-box {
        display: flex; align-items: stretch; gap: 1rem; flex-wrap: wrap;
        padding: 1rem 1.125rem; background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 0.75rem;
        font-family: Inter, sans-serif;
    }
    .bcbg-header { display: flex; align-items: center; gap: 0.625rem; font-size: 0.875rem; color: #0c4a6e; font-weight: 600; flex-basis: 100%; }
    .bcbg-control { display: flex; align-items: center; gap: 0.625rem; }
    .bcbg-label { font-size: 0.8125rem; color: #475569; font-weight: 500; min-width: 60px; }
    .bcbg-color-input {
        width: 44px; height: 36px; padding: 0; border: 2px solid #cbd5e1; border-radius: 0.5rem;
        cursor: pointer; background: transparent;
    }
    .bcbg-color-text {
        width: 110px; padding: 0.5rem 0.625rem; border: 1px solid #cbd5e1; border-radius: 0.5rem;
        font-family: monospace; font-size: 0.8125rem;
    }
    .bcbg-clear {
        padding: 0.375rem 0.625rem; border: 1px solid #cbd5e1; background: white;
        border-radius: 0.5rem; cursor: pointer; font-size: 0.75rem; color: #64748b;
    }
    .bcbg-clear:hover { background: #fee2e2; border-color: #fca5a5; color: #b91c1c; }
    .bcbg-img-btn {
        display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.875rem;
        background: #0ea5e9; color: white; border: none; border-radius: 0.5rem; cursor: pointer;
        font-size: 0.8125rem; font-weight: 500;
    }
    .bcbg-img-btn:hover { background: #0284c7; }
    .bcbg-img-preview {
        width: 60px; height: 36px; border-radius: 0.375rem; background-size: cover;
        background-position: center; border: 1px solid #cbd5e1;
    }
</style>

<div class="bcbg-wrap">
    <div class="bcbg-box">
        <div class="bcbg-header">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="color:#0ea5e9; flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
            </svg>
            <span>Üst Bölüm Arka Planı</span>
            <span style="font-weight:400; font-size: 0.75rem; color:#64748b;">— Renk + opsiyonel görsel</span>
        </div>

        {{-- RENK --}}
        <div class="bcbg-control">
            <span class="bcbg-label">Renk:</span>
            <input type="color" class="bcbg-color-input"
                   :value="fields.breadcrumb_bg_color || '#FAF9F6'"
                   @input="fields.breadcrumb_bg_color = $event.target.value">
            <input type="text" class="bcbg-color-text"
                   x-model="fields.breadcrumb_bg_color"
                   placeholder="#FAF9F6">
            <button type="button" class="bcbg-clear"
                    @click="fields.breadcrumb_bg_color = ''"
                    title="Varsayılan renge dön">↺</button>
        </div>

        {{-- GÖRSEL --}}
        <div class="bcbg-control">
            <span class="bcbg-label">Görsel:</span>
            <div class="bcbg-img-preview"
                 :style="fields.breadcrumb_bg_image ? 'background-image: url(' + (fields.breadcrumb_bg_image.startsWith('http') ? fields.breadcrumb_bg_image : baseUrl + '/' + fields.breadcrumb_bg_image) + ')' : 'background: repeating-linear-gradient(45deg, #e2e8f0, #e2e8f0 4px, #f8fafc 4px, #f8fafc 8px)'"></div>
            <button type="button" class="bcbg-img-btn"
                    @click="openModal('breadcrumb_bg_image', 'Üst Bölüm Arka Plan Görseli', 'image')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"/></svg>
                <span x-text="fields.breadcrumb_bg_image ? 'Değiştir' : 'Yükle'"></span>
            </button>
            <button type="button" class="bcbg-clear" x-show="fields.breadcrumb_bg_image"
                    @click="fields.breadcrumb_bg_image = ''"
                    title="Görseli kaldır">✕</button>
        </div>
    </div>
</div>
