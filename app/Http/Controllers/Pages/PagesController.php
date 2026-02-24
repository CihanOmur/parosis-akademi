<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Faq\Faq;
use App\Models\Pages\Contact\ContactPageInfo;
use App\Models\Pages\Faq\FaqPageInfo;
use App\Models\Pages\Blog\BlogPageInfo;
use App\Models\Pages\Teacher\TeacherPageInfo;
use App\Models\Blogs\Blog;
use App\Models\Blogs\BlogCategory;
use App\Models\Blogs\BlogTag;
use App\Models\Teacher\Teacher;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    // ─── Dispatcher ──────────────────────────────────────────────────────────

    public function edit(Request $request, $id)
    {
        return match ($id) {
            'contact'  => $this->editContact($request),
            'faq'      => $this->editFaq($request),
            'teachers' => $this->editTeachers($request),
            'blog'     => $this->editBlog($request),
            default    => abort(404),
        };
    }

    public function update(Request $request, $id)
    {
        return match ($id) {
            'contact'  => $this->updateContact($request),
            'faq'      => $this->updateFaq($request),
            'teachers' => $this->updateTeachers($request),
            'blog'     => $this->updateBlog($request),
            default    => abort(404),
        };
    }

    public function editTranslate(Request $request, $lang, $id)
    {
        return match ($id) {
            'contact'  => $this->editContactTranslate($request, $lang),
            'faq'      => $this->editFaqTranslate($request, $lang),
            'teachers' => $this->editTeachersTranslate($request, $lang),
            'blog'     => $this->editBlogTranslate($request, $lang),
            default    => abort(404),
        };
    }

    public function updateTranslate(Request $request, $id)
    {
        return match ($id) {
            'contact'  => $this->updateContactTranslate($request),
            'faq'      => $this->updateFaqTranslate($request),
            'teachers' => $this->updateTeachersTranslate($request),
            'blog'     => $this->updateBlogTranslate($request),
            default    => abort(404),
        };
    }

    // ─── Contact Page ──────────────────────────────────────────────────────────

    private function editContact(Request $request)
    {
        $contactPageInfo = ContactPageInfo::first();
        if (!$contactPageInfo) {
            $contactPageInfo = ContactPageInfo::create([]);
        }

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-contact', compact('contactPageInfo', 'selectedLang', 'selectedLanguage'));
    }

    private function updateContact(Request $request)
    {
        $contactPageInfo = ContactPageInfo::first();
        if (!$contactPageInfo) {
            $contactPageInfo = ContactPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        // Translatable fields
        $translatableFields = [
            'title', 'subtitle', 'form_title', 'form_description',
            'form_name_placeholder', 'form_email_placeholder',
            'form_message_placeholder', 'form_privacy_text', 'form_button_text',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
            'breadcrumb_home', 'breadcrumb_current',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $contactPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // 'content' maps to 'description'
        if ($request->has('content')) {
            $contactPageInfo->setTranslation('description', $locale, $request->content);
        }

        // Non-translatable fields
        $nonTranslatableFields = [
            'phone_1', 'phone_2', 'email_1', 'email_2',
            'address_line_1', 'address_line_2', 'map_embed_url',
            'cta_button_url', 'cta_image',
            'contact_form_image', 'form_action_url',
        ];

        foreach ($nonTranslatableFields as $field) {
            if ($request->has($field)) {
                $contactPageInfo->$field = $request->$field;
            }
        }

        // Dynamic array fields (phones, emails, addresses)
        $arrayLimits = ['phones' => 25, 'emails' => 100, 'addresses' => 250];
        foreach ($arrayLimits as $arrayField => $maxLen) {
            if ($request->has($arrayField)) {
                $values = $request->$arrayField;
                if (is_string($values)) {
                    $values = json_decode($values, true) ?? [];
                }
                $values = array_values(array_filter($values, fn($v) => trim($v) !== ''));
                // Enforce max length per item and max 10 items
                $values = array_slice($values, 0, 10);
                $values = array_map(fn($v) => mb_substr($v, 0, $maxLen), $values);
                $contactPageInfo->$arrayField = $values;
            }
        }

        $contactPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'İletişim sayfası başarıyla güncellendi.');
    }

    private function editContactTranslate(Request $request, $lang)
    {
        return redirect()->route('pages.edit', ['id' => 'contact', 'lang' => $lang]);
    }

    private function updateContactTranslate(Request $request)
    {
        $contactPageInfo = ContactPageInfo::first();
        if (!$contactPageInfo) {
            $contactPageInfo = ContactPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'subtitle', 'form_title', 'form_description',
            'form_name_placeholder', 'form_email_placeholder',
            'form_message_placeholder', 'form_privacy_text', 'form_button_text',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
            'breadcrumb_home', 'breadcrumb_current',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $contactPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        if ($request->has('content')) {
            $contactPageInfo->setTranslation('description', $locale, $request->content);
        }

        $contactPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Çeviri kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Çeviri başarıyla güncellendi.');
    }

    // ─── FAQ Page ────────────────────────────────────────────────────────────

    private function editFaq(Request $request)
    {
        $faqPageInfo = FaqPageInfo::first();
        if (!$faqPageInfo) {
            $faqPageInfo = FaqPageInfo::create([]);
        }

        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-faq', compact('faqPageInfo', 'faqs', 'selectedLang', 'selectedLanguage'));
    }

    private function updateFaq(Request $request)
    {
        $faqPageInfo = FaqPageInfo::first();
        if (!$faqPageInfo) {
            $faqPageInfo = FaqPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'subtitle', 'section_label', 'section_title',
            'form_title', 'form_description',
            'form_name_placeholder', 'form_email_placeholder',
            'form_message_placeholder', 'form_privacy_text', 'form_button_text',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
            'breadcrumb_home', 'breadcrumb_current',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $faqPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        if ($request->has('content')) {
            $faqPageInfo->setTranslation('description', $locale, $request->content);
        }

        // Non-translatable fields
        $nonTranslatableFields = [
            'cta_button_url', 'cta_image',
            'contact_form_image', 'form_action_url',
        ];

        foreach ($nonTranslatableFields as $field) {
            if ($request->has($field)) {
                $faqPageInfo->$field = $request->$field;
            }
        }

        $faqPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'SSS sayfası başarıyla güncellendi.');
    }

    private function editFaqTranslate(Request $request, $lang)
    {
        return redirect()->route('pages.edit', ['id' => 'faq', 'lang' => $lang]);
    }

    private function updateFaqTranslate(Request $request)
    {
        $faqPageInfo = FaqPageInfo::first();
        if (!$faqPageInfo) {
            $faqPageInfo = FaqPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'subtitle', 'section_label', 'section_title',
            'form_title', 'form_description',
            'form_name_placeholder', 'form_email_placeholder',
            'form_message_placeholder', 'form_privacy_text', 'form_button_text',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
            'breadcrumb_home', 'breadcrumb_current',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $faqPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        if ($request->has('content')) {
            $faqPageInfo->setTranslation('description', $locale, $request->content);
        }

        $faqPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Çeviri kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Çeviri başarıyla güncellendi.');
    }

    // ─── Teachers Page ──────────────────────────────────────────────────────────

    private function editTeachers(Request $request)
    {
        $teacherPageInfo = TeacherPageInfo::first();
        if (!$teacherPageInfo) {
            $teacherPageInfo = TeacherPageInfo::create([]);
        }

        $teachers = Teacher::where('is_active', true)->orderBy('sort_order')->get();

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-teachers', compact('teacherPageInfo', 'teachers', 'selectedLang', 'selectedLanguage'));
    }

    private function updateTeachers(Request $request)
    {
        $teacherPageInfo = TeacherPageInfo::first();
        if (!$teacherPageInfo) {
            $teacherPageInfo = TeacherPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'subtitle',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
            'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $teacherPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Non-translatable fields
        $nonTranslatableFields = ['cta_button_url', 'cta_image'];

        foreach ($nonTranslatableFields as $field) {
            if ($request->has($field)) {
                $teacherPageInfo->$field = $request->$field;
            }
        }

        $teacherPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Eğitmenler sayfası başarıyla güncellendi.');
    }

    private function editTeachersTranslate(Request $request, $lang)
    {
        return redirect()->route('pages.edit', ['id' => 'teachers', 'lang' => $lang]);
    }

    private function updateTeachersTranslate(Request $request)
    {
        $teacherPageInfo = TeacherPageInfo::first();
        if (!$teacherPageInfo) {
            $teacherPageInfo = TeacherPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'subtitle',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
            'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $teacherPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        $teacherPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Çeviri kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Çeviri başarıyla güncellendi.');
    }

    // ─── Blog Page ──────────────────────────────────────────────────────────

    private function editBlog(Request $request)
    {
        $blogPageInfo = BlogPageInfo::first();
        if (!$blogPageInfo) {
            $blogPageInfo = BlogPageInfo::create([]);
        }

        $blogs = Blog::with(['categories', 'blogTags'])->where('is_active', true)->orderBy('sort_order')->take(3)->get();

        $categories = BlogCategory::where('is_active', true)
            ->withCount(['blogs' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        $tags = BlogTag::where('is_active', true)->orderBy('sort_order')->get();

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-blog', compact('blogPageInfo', 'blogs', 'categories', 'tags', 'selectedLang', 'selectedLanguage'));
    }

    private function updateBlog(Request $request)
    {
        $blogPageInfo = BlogPageInfo::first();
        if (!$blogPageInfo) {
            $blogPageInfo = BlogPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
            'sidebar_search_title', 'sidebar_search_placeholder',
            'sidebar_categories_title', 'sidebar_popular_title',
            'sidebar_contact_title', 'sidebar_tags_title',
            'sidebar_contact_phone_label', 'sidebar_contact_phone',
            'sidebar_contact_email_label', 'sidebar_contact_email',
            'sidebar_contact_address_label', 'sidebar_contact_address',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $blogPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Non-translatable fields
        $nonTranslatableFields = ['cta_button_url', 'cta_image'];

        foreach ($nonTranslatableFields as $field) {
            if ($request->has($field)) {
                $blogPageInfo->$field = $request->$field;
            }
        }

        $blogPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Blog sayfası başarıyla güncellendi.');
    }

    private function editBlogTranslate(Request $request, $lang)
    {
        return redirect()->route('pages.edit', ['id' => 'blog', 'lang' => $lang]);
    }

    private function updateBlogTranslate(Request $request)
    {
        $blogPageInfo = BlogPageInfo::first();
        if (!$blogPageInfo) {
            $blogPageInfo = BlogPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
            'sidebar_search_title', 'sidebar_search_placeholder',
            'sidebar_categories_title', 'sidebar_popular_title',
            'sidebar_contact_title', 'sidebar_tags_title',
            'sidebar_contact_phone_label', 'sidebar_contact_phone',
            'sidebar_contact_email_label', 'sidebar_contact_email',
            'sidebar_contact_address_label', 'sidebar_contact_address',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $blogPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        $blogPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Çeviri kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Çeviri başarıyla güncellendi.');
    }

    // ─── Image Upload ─────────────────────────────────────────────────────────

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,webp,svg,ico|max:5120',
        ]);

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/pages'), $filename);

        return response()->json([
            'success' => true,
            'path' => 'uploads/pages/' . $filename,
            'url' => asset('uploads/pages/' . $filename),
        ]);
    }
}
