/**
 * TinyMCE self-hosted init script.
 * tinymce.min.js public/tinymce'ten global script ile önce yüklenir (window.tinymce).
 * Bu modül `textarea.tinymce-editor` selector'larını rich editor'e dönüştürür.
 *
 * data-upload-url attribute ile resim yükleme endpoint'i belirtilebilir.
 */
const BASE_URL = '/tinymce';
const OVERLAY_CLASS = 'tinymce-loading-overlay';

function showLoadingOverlays() {
    const textareas = document.querySelectorAll('textarea.tinymce-editor');
    textareas.forEach((ta) => {
        const parent = ta.parentElement;
        if (!parent || parent.querySelector('.' + OVERLAY_CLASS)) return;
        const computed = window.getComputedStyle(parent);
        if (computed.position === 'static') parent.style.position = 'relative';

        const rect = ta.getBoundingClientRect();
        const minH = Math.max(rect.height, 500);

        const overlay = document.createElement('div');
        overlay.className = OVERLAY_CLASS;
        overlay.setAttribute('data-target', ta.id || ta.name || '');
        overlay.style.cssText = [
            'position:absolute',
            'inset:0',
            'min-height:' + minH + 'px',
            'background:#f8fafc',
            'border-radius:12px',
            'border:1px solid #e2e8f0',
            'display:flex',
            'flex-direction:column',
            'align-items:center',
            'justify-content:center',
            'gap:12px',
            'z-index:5',
            'pointer-events:none',
        ].join(';');
        overlay.innerHTML =
            '<div style="width:36px;height:36px;border:3px solid #cbd5e1;border-top-color:#6340FF;border-radius:50%;animation:tinymce-spin 0.8s linear infinite"></div>' +
            '<p style="font-size:13px;color:#64748b;margin:0;font-weight:500">Editör yükleniyor...</p>';
        parent.appendChild(overlay);
    });

    if (!document.getElementById('tinymce-spin-css')) {
        const style = document.createElement('style');
        style.id = 'tinymce-spin-css';
        style.textContent = '@keyframes tinymce-spin{to{transform:rotate(360deg)}}';
        document.head.appendChild(style);
    }
}

function hideLoadingOverlay(editor) {
    const ta = editor && editor.targetElm;
    if (!ta || !ta.parentElement) return;
    const overlay = ta.parentElement.querySelector('.' + OVERLAY_CLASS);
    if (overlay) overlay.remove();
}

function initEditor() {
    if (typeof window.tinymce === 'undefined') {
        console.error('[tinymce-init] window.tinymce yüklenmemiş. tinymce.min.js script tag eksik mi?');
        return;
    }

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

    window.tinymce.init({
        selector: 'textarea.tinymce-editor',
        base_url: BASE_URL,
        suffix: '.min',
        height: 500,
        menubar: 'edit view insert format table',
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
            'preview', 'anchor', 'searchreplace', 'visualblocks', 'code',
            'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount',
        ],
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
                 'alignleft aligncenter alignright alignjustify | ' +
                 'bullist numlist outdent indent | link image media table | ' +
                 'forecolor backcolor removeformat | code fullscreen help',
        block_formats: 'Paragraf=p; Başlık 1=h1; Başlık 2=h2; Başlık 3=h3; Başlık 4=h4; Önemli=blockquote; Kod=pre',
        content_style: 'body { font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif; font-size: 15px; line-height: 1.6; color: #1e293b; } img { max-width: 100%; height: auto; }',
        branding: false,
        promotion: false,
        license_key: 'gpl',
        init_instance_callback: (editor) => hideLoadingOverlay(editor),
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        image_caption: true,
        image_advtab: true,
        image_dimensions: false,
        automatic_uploads: true,
        paste_data_images: false,
        images_file_types: 'jpeg,jpg,png,webp,gif',
        file_picker_types: 'image',
        images_upload_handler: async (blobInfo) => {
            const editor = window.tinymce.activeEditor;
            const uploadUrl = editor && editor.targetElm && editor.targetElm.dataset.uploadUrl;
            if (!uploadUrl) {
                throw 'Resim yükleme URL\'i tanımlı değil (data-upload-url eksik).';
            }
            const form = new FormData();
            form.append('image', blobInfo.blob(), blobInfo.filename());
            const res = await fetch(uploadUrl, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: form,
            });
            if (!res.ok) {
                const msg = await res.text().catch(() => res.statusText);
                throw 'Resim yüklenemedi: ' + (msg || res.status);
            }
            const data = await res.json();
            if (!data.location) {
                throw 'Sunucu geçerli bir konum döndürmedi.';
            }
            return data.location;
        },
    });
}

function boot() {
    showLoadingOverlays();
    initEditor();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}
