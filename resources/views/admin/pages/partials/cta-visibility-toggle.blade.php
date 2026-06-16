{{--
    Ana editör Alpine scope'unda `fields.cta_enabled` boolean'ı olmalı.
    Toggle aç/kapa onu değiştirir; AJAX submit'inde formData'ya append edilir.
--}}
<style>
    .cta-toggle-wrap { padding: 0 1.25rem; margin: 1rem auto; max-width: 1200px; }
    .cta-toggle-box {
        display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        padding: 0.875rem 1.125rem;
        background: #faf5ff; border: 1px solid #e9d5ff; border-radius: 0.75rem;
        font-family: Inter, sans-serif;
    }
    .cta-toggle-info { display: flex; align-items: center; gap: 0.625rem; font-size: 0.875rem; color: #475569; }
    .cta-toggle-info strong { color: #581c87; }
    .cta-toggle-status { font-weight: 600; font-size: 0.8125rem; }
    .cta-toggle-status.is-on { color: #16a34a; }
    .cta-toggle-status.is-off { color: #dc2626; }

    .cta-switch { display: inline-flex; align-items: center; gap: 0.625rem; cursor: pointer; user-select: none; }
    .cta-switch-label { font-size: 0.8125rem; color: #64748b; font-weight: 500; }
    .cta-switch-input { position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none; }
    .cta-switch-track {
        position: relative; display: inline-block;
        width: 44px; height: 24px; border-radius: 999px;
        background: #cbd5e1;
        transition: background .2s;
    }
    .cta-switch-thumb {
        position: absolute; top: 2px; left: 2px;
        width: 20px; height: 20px; border-radius: 50%;
        background: white; box-shadow: 0 1px 3px rgba(0,0,0,.2);
        transition: transform .2s;
    }
    .cta-switch-input:checked ~ .cta-switch-track { background: #9333ea; }
    .cta-switch-input:checked ~ .cta-switch-track .cta-switch-thumb { transform: translateX(20px); }
</style>

<div class="cta-toggle-wrap">
    <div class="cta-toggle-box">
        <div class="cta-toggle-info">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="color:#9333ea; flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15"/>
            </svg>
            <strong>CTA Bölümü</strong>
            <span class="cta-toggle-status"
                  :class="fields.cta_enabled ? 'is-on' : 'is-off'"
                  x-text="fields.cta_enabled ? '• Görünür' : '• Gizli'"></span>
        </div>

        <label class="cta-switch">
            <span class="cta-switch-label">Sayfada göster</span>
            <input type="checkbox" class="cta-switch-input" x-model="fields.cta_enabled">
            <span class="cta-switch-track">
                <span class="cta-switch-thumb"></span>
            </span>
        </label>
    </div>
</div>
