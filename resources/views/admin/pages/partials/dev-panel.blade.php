{{-- Developer Mode Panel (shared partial) --}}
<div x-show="devMode" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
     style="margin-bottom: 1.25rem; background: #fff; border-radius: 14px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #E5E7EB; overflow: hidden;">

    {{-- Header --}}
    <div style="display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; background: #F9FAFB; border-bottom: 1px solid #E5E7EB;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <svg style="width: 18px; height: 18px; color: #6B7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <div>
                <span style="font-size: 0.9375rem; font-weight: 600; color: #1F2937;">Varsayilan Stiller</span>
                <span style="font-size: 0.8125rem; color: #9CA3AF; margin-left: 8px;">"Varsayilana Sifirla" degerlerini ayarlayin</span>
            </div>
        </div>
        <button type="button" @click="saveDefaults()" :disabled="savingDefaults" class="dev-save-btn">
            <svg x-show="!savingDefaults" style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            <svg x-show="savingDefaults" style="width: 15px; height: 15px;" class="animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
            Kaydet
        </button>
    </div>

    {{-- Table Header --}}
    <div style="display: grid; grid-template-columns: 220px 1fr 110px 140px 40px; gap: 0; padding: 8px 20px; background: #F9FAFB; border-bottom: 1px solid #E5E7EB; font-size: 0.75rem; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.05em;">
        <span>Alan</span>
        <span>Renk</span>
        <span>Boyut</span>
        <span>Hizalama</span>
        <span></span>
    </div>

    {{-- Sections --}}
    <div style="padding: 0;">
        <template x-for="section in devSections" :key="section.title">
            <div>
                <div style="display: flex; align-items: center; gap: 10px; padding: 10px 20px; background: #F3F4F6; border-bottom: 1px solid #E5E7EB;">
                    <div :style="'width: 4px; height: 16px; border-radius: 2px; background:' + section.color"></div>
                    <span x-text="section.title" style="font-size: 0.8125rem; font-weight: 700; color: #4B5563; text-transform: uppercase; letter-spacing: 0.04em;"></span>
                    <span x-text="section.desc" style="font-size: 0.75rem; color: #9CA3AF; font-weight: 400;"></span>
                </div>
                <template x-for="field in section.fields" :key="field.key">
                    <div :class="customDefaults[field.key] ? 'dev-row dev-row-modified' : 'dev-row'">
                        <div>
                            <div x-text="field.label" style="font-size: 0.875rem; font-weight: 500; color: #1F2937; line-height: 1.2;"></div>
                            <div x-text="field.desc" x-show="field.desc" style="font-size: 0.6875rem; color: #9CA3AF; line-height: 1.3; margin-top: 1px;"></div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <input type="color" :value="getDevProp(field.key, 'color') || '#011c1a'" @input="setDevProp(field.key, 'color', $event.target.value)" class="dev-color-input" />
                            <input type="text" :value="getDevProp(field.key, 'color') || '#011c1a'" @change="setDevProp(field.key, 'color', $event.target.value)" maxlength="22" class="dev-text-input" />
                        </div>
                        <select :value="getDevProp(field.key, 'fontSize') || ''" @change="setDevProp(field.key, 'fontSize', $event.target.value)" class="dev-select">
                            <option value="">—</option>
                            <option value="0.75rem">12px</option>
                            <option value="0.875rem">14px</option>
                            <option value="1rem">16px</option>
                            <option value="1.125rem">18px</option>
                            <option value="1.25rem">20px</option>
                            <option value="1.5rem">24px</option>
                            <option value="1.875rem">30px</option>
                            <option value="2rem">32px</option>
                            <option value="2.25rem">36px</option>
                            <option value="2.5rem">40px</option>
                            <option value="3rem">48px</option>
                        </select>
                        <div style="display: flex; gap: 6px; width: fit-content;">
                            <button type="button" @click="setDevProp(field.key, 'textAlign', 'left')" :class="'dev-align-btn' + (getDevProp(field.key, 'textAlign') === 'left' ? ' active' : '')">
                                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" d="M3 6h18M3 12h12M3 18h15"/></svg>
                            </button>
                            <button type="button" @click="setDevProp(field.key, 'textAlign', 'center')" :class="'dev-align-btn' + (getDevProp(field.key, 'textAlign') === 'center' ? ' active' : '')">
                                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" d="M3 6h18M6 12h12M4.5 18h15"/></svg>
                            </button>
                            <button type="button" @click="setDevProp(field.key, 'textAlign', 'right')" :class="'dev-align-btn' + (getDevProp(field.key, 'textAlign') === 'right' ? ' active' : '')">
                                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" d="M3 6h18M9 12h12M6 18h15"/></svg>
                            </button>
                        </div>
                        <div style="text-align: center;">
                            <button type="button" @click="resetDevField(field.key)" x-show="customDefaults[field.key]" class="dev-reset-btn" title="Orijinal varsayilana don">&#x2715;</button>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>
