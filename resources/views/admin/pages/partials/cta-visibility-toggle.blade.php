{{--
    Ana editör Alpine scope'unda `fields.cta_enabled` boolean'ı olmalı.
    Toggle aç/kapa onu değiştirir; AJAX submit'inde formData'ya append edilir.
--}}
<div style="padding: 0 1.25rem; margin: 1rem auto; max-width: 1200px;">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.875rem 1.125rem; background: #faf5ff; border: 1px solid #e9d5ff; border-radius: 0.75rem;">
        <div style="font-size: 0.875rem; color: #475569; display: flex; align-items: center; gap: 0.625rem;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="color:#9333ea; flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15"/>
            </svg>
            <strong style="color:#581c87;">CTA Bölümü</strong>
            <span x-text="fields.cta_enabled ? '• Görünür' : '• Gizli'"
                  :style="fields.cta_enabled ? 'color:#16a34a' : 'color:#dc2626'"
                  style="font-weight: 600; font-size: 0.8125rem;"></span>
        </div>

        <label style="display: inline-flex; align-items: center; gap: 0.625rem; cursor: pointer; user-select: none;">
            <span style="font-size: 0.8125rem; color: #64748b; font-weight: 500;">Sayfada göster</span>
            <button type="button" @click="fields.cta_enabled = !fields.cta_enabled"
                    :style="fields.cta_enabled ? 'background:#9333ea' : 'background:#cbd5e1'"
                    style="position: relative; width: 44px; height: 24px; border-radius: 999px; border: none; cursor: pointer; transition: background .2s; padding: 0;">
                <span :style="fields.cta_enabled ? 'transform: translateX(20px)' : 'transform: translateX(0)'"
                      style="position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background: white; border-radius: 50%; transition: transform .2s; box-shadow: 0 1px 3px rgba(0,0,0,.2);"></span>
            </button>
        </label>
    </div>
</div>
