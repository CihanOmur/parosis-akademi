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
use App\Models\Courses\Course;
use App\Models\Courses\CourseCategory;
use App\Models\Pages\Course\CoursePageInfo;
use App\Models\Pages\AboutUs\AboutUsPageInfo;
use App\Models\Pages\Footer\FooterPageInfo;
use App\Models\Pages\Home\HomePageInfo;
use App\Models\MenuItem;
use App\Models\Pages\Navbar\NavbarPageInfo;
use App\Models\Pages\Shop\ShopPageInfo;
use App\Models\Shop\Product;
use App\Models\Shop\ProductCategory;
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
            'home'     => $this->editHome($request),
            'about'    => $this->editAbout($request),
            'contact'  => $this->editContact($request),
            'faq'      => $this->editFaq($request),
            'teachers' => $this->editTeachers($request),
            'blog'     => $this->editBlog($request),
            'courses'  => $this->editCourses($request),
            'footer'   => $this->editFooter($request),
            'navbar'   => $this->editNavbar($request),
            'shop'     => $this->editShop($request),
            default    => abort(404),
        };
    }

    public function update(Request $request, $id)
    {
        return match ($id) {
            'home'     => $this->updateHome($request),
            'about'    => $this->updateAbout($request),
            'contact'  => $this->updateContact($request),
            'faq'      => $this->updateFaq($request),
            'teachers' => $this->updateTeachers($request),
            'blog'     => $this->updateBlog($request),
            'courses'  => $this->updateCourses($request),
            'footer'   => $this->updateFooter($request),
            'navbar'   => $this->updateNavbar($request),
            'shop'     => $this->updateShop($request),
            default    => abort(404),
        };
    }

    public function editTranslate(Request $request, $lang, $id)
    {
        return match ($id) {
            'home'     => $this->editHomeTranslate($request, $lang),
            'about'    => $this->editAboutTranslate($request, $lang),
            'contact'  => $this->editContactTranslate($request, $lang),
            'faq'      => $this->editFaqTranslate($request, $lang),
            'teachers' => $this->editTeachersTranslate($request, $lang),
            'blog'     => $this->editBlogTranslate($request, $lang),
            'courses'  => $this->editCoursesTranslate($request, $lang),
            'footer'   => $this->editFooterTranslate($request, $lang),
            'navbar'   => $this->editNavbarTranslate($request, $lang),
            'shop'     => $this->editShopTranslate($request, $lang),
            default    => abort(404),
        };
    }

    public function updateTranslate(Request $request, $id)
    {
        return match ($id) {
            'home'     => $this->updateHomeTranslate($request),
            'about'    => $this->updateAboutTranslate($request),
            'contact'  => $this->updateContactTranslate($request),
            'faq'      => $this->updateFaqTranslate($request),
            'teachers' => $this->updateTeachersTranslate($request),
            'blog'     => $this->updateBlogTranslate($request),
            'courses'  => $this->updateCoursesTranslate($request),
            'footer'   => $this->updateFooterTranslate($request),
            'navbar'   => $this->updateNavbarTranslate($request),
            'shop'     => $this->updateShopTranslate($request),
            default    => abort(404),
        };
    }

    // ─── Home Page ──────────────────────────────────────────────────────────

    private function editHome(Request $request)
    {
        $homePageInfo = HomePageInfo::first();
        if (!$homePageInfo) {
            $homePageInfo = HomePageInfo::create([]);
        }

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        $ctaInfo = ContactPageInfo::first();
        if (!$ctaInfo) {
            $ctaInfo = ContactPageInfo::create([]);
        }

        return view('admin.pages.edit-home', compact('homePageInfo', 'ctaInfo', 'selectedLang', 'selectedLanguage'));
    }

    private function updateHome(Request $request)
    {
        $homePageInfo = HomePageInfo::first();
        if (!$homePageInfo) {
            $homePageInfo = HomePageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'welcome_label', 'welcome_title', 'welcome_description',
            'welcome_stat_text',
            'categories_label', 'categories_title', 'categories_button_text',
            'why_label', 'why_title', 'why_description', 'why_stat_text',
            'client_logo_text',
            'courses_label', 'courses_title',
            'blog_label', 'blog_title',
            'testimonial_label', 'testimonial_title', 'testimonial_stat_text',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $homePageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Welcome features — JSON array of strings
        if ($request->has('welcome_features')) {
            $decoded = json_decode($request->welcome_features, true);
            if (is_array($decoded)) {
                $homePageInfo->setTranslation('welcome_features', $locale, $decoded);
            }
        }

        // Features — JSON array [{title, description, icon, bg_color}]
        if ($request->has('features')) {
            $decoded = json_decode($request->features, true);
            if (is_array($decoded)) {
                $homePageInfo->setTranslation('features', $locale, $decoded);
            }
        }

        // Why items — JSON array [{title, description, icon, bg_color}]
        if ($request->has('why_items')) {
            $decoded = json_decode($request->why_items, true);
            if (is_array($decoded)) {
                $homePageInfo->setTranslation('why_items', $locale, $decoded);
            }
        }

        // Fun-fact items — JSON array [{number, text}]
        if ($request->has('funfact_items')) {
            $decoded = json_decode($request->funfact_items, true);
            if (is_array($decoded)) {
                $homePageInfo->setTranslation('funfact_items', $locale, $decoded);
            }
        }

        // Non-translatable fields
        $nonTranslatableFields = ['welcome_image', 'welcome_stat_number', 'categories_button_url', 'why_image', 'why_stat_number', 'funfact_image', 'testimonial_image', 'testimonial_stat_number'];

        foreach ($nonTranslatableFields as $field) {
            if ($request->has($field)) {
                $homePageInfo->$field = $request->$field;
            }
        }

        if ($request->has('field_styles')) {
            $homePageInfo->field_styles = json_decode($request->field_styles, true);
        }

        if ($request->has('default_styles')) {
            $homePageInfo->default_styles = json_decode($request->default_styles, true);
        }

        $homePageInfo->save();

        // CTA (ContactPageInfo)
        $ctaTranslatable = ['cta_label', 'cta_title', 'cta_description', 'cta_button_text'];
        $hasCtaData = false;
        foreach ($ctaTranslatable as $field) {
            if ($request->has($field)) $hasCtaData = true;
        }
        if ($hasCtaData || $request->has('cta_image') || $request->has('cta_button_url')) {
            $ctaInfo = ContactPageInfo::first() ?? ContactPageInfo::create([]);
            foreach ($ctaTranslatable as $field) {
                if ($request->has($field)) {
                    $ctaInfo->setTranslation($field, $locale, $request->$field);
                }
            }
            if ($request->has('cta_image')) $ctaInfo->cta_image = $request->cta_image;
            if ($request->has('cta_button_url')) $ctaInfo->cta_button_url = $request->cta_button_url;
            $ctaInfo->save();
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Ana sayfa başarıyla güncellendi.');
    }

    private function editHomeTranslate(Request $request, $lang)
    {
        return redirect()->route('pages.edit', ['id' => 'home', 'lang' => $lang]);
    }

    private function updateHomeTranslate(Request $request)
    {
        $homePageInfo = HomePageInfo::first();
        if (!$homePageInfo) {
            $homePageInfo = HomePageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'welcome_label', 'welcome_title', 'welcome_description',
            'welcome_stat_text',
            'categories_label', 'categories_title', 'categories_button_text',
            'why_label', 'why_title', 'why_description', 'why_stat_text',
            'client_logo_text',
            'courses_label', 'courses_title',
            'blog_label', 'blog_title',
            'testimonial_label', 'testimonial_title', 'testimonial_stat_text',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $homePageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Welcome features — JSON array of strings
        if ($request->has('welcome_features')) {
            $decoded = json_decode($request->welcome_features, true);
            if (is_array($decoded)) {
                $homePageInfo->setTranslation('welcome_features', $locale, $decoded);
            }
        }

        // Features — JSON array [{title, description, icon, bg_color}]
        if ($request->has('features')) {
            $decoded = json_decode($request->features, true);
            if (is_array($decoded)) {
                $homePageInfo->setTranslation('features', $locale, $decoded);
            }
        }

        // Why items — JSON array [{title, description, icon, bg_color}]
        if ($request->has('why_items')) {
            $decoded = json_decode($request->why_items, true);
            if (is_array($decoded)) {
                $homePageInfo->setTranslation('why_items', $locale, $decoded);
            }
        }

        // Fun-fact items — JSON array [{number, text}]
        if ($request->has('funfact_items')) {
            $decoded = json_decode($request->funfact_items, true);
            if (is_array($decoded)) {
                $homePageInfo->setTranslation('funfact_items', $locale, $decoded);
            }
        }

        $homePageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Çeviri kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Çeviri başarıyla güncellendi.');
    }

    // ─── About Page ──────────────────────────────────────────────────────────

    private function editAbout(Request $request)
    {
        $aboutPageInfo = AboutUsPageInfo::first();
        if (!$aboutPageInfo) {
            $aboutPageInfo = AboutUsPageInfo::create([]);
        }

        $footerCtaInfo = ContactPageInfo::first();
        if (!$footerCtaInfo) {
            $footerCtaInfo = ContactPageInfo::create([]);
        }

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-about', compact('aboutPageInfo', 'footerCtaInfo', 'selectedLang', 'selectedLanguage'));
    }

    private function updateAbout(Request $request)
    {
        $aboutPageInfo = AboutUsPageInfo::first();
        if (!$aboutPageInfo) {
            $aboutPageInfo = AboutUsPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'breadcrumb_title', 'breadcrumb_home', 'breadcrumb_current',
            'section1_label', 'section1_title', 'section1_description',
            'section1_stat_text',
            'categories_label', 'categories_title', 'categories_button_text',
            'logos_text',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
            'section2_label', 'section2_title', 'section2_description',
            'section2_stat_text',
            'testimonial_label', 'testimonial_title',
            'faq_label', 'faq_title',
            'blog_label', 'blog_title',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $aboutPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Section 1 features — JSON array [{title, description, icon, bg_color}]
        if ($request->has('section1_features')) {
            $features = json_decode($request->section1_features, true);
            if (is_array($features)) {
                $aboutPageInfo->setTranslation('section1_features', $locale, $features);
            }
        }

        // Section 2 features — JSON array of strings
        if ($request->has('section2_features')) {
            $s2features = json_decode($request->section2_features, true);
            if (is_array($s2features)) {
                $aboutPageInfo->setTranslation('section2_features', $locale, $s2features);
            } else {
                // backward compat: newline-separated string
                $aboutPageInfo->setTranslation('section2_features', $locale, $request->section2_features);
            }
        }

        $nonTranslatableFields = [
            'section1_image1', 'section1_image2', 'section1_stat_number',
            'video_image', 'video_url',
            'cta_image',
            'section2_image', 'section2_stat_number',
            'faq_image1', 'faq_image2', 'faq_image3',
        ];

        foreach ($nonTranslatableFields as $field) {
            if ($request->has($field)) {
                $aboutPageInfo->$field = $request->$field;
            }
        }

        if ($request->has('field_styles')) {
            $aboutPageInfo->field_styles = json_decode($request->field_styles, true);
        }

        if ($request->has('default_styles')) {
            $aboutPageInfo->default_styles = json_decode($request->default_styles, true);
        }

        $aboutPageInfo->save();

        // Footer CTA (ContactPageInfo)
        $footerCtaTranslatable = ['footer_cta_label', 'footer_cta_title', 'footer_cta_description', 'footer_cta_button_text'];
        $hasFooterCta = false;
        foreach ($footerCtaTranslatable as $field) {
            if ($request->has($field)) { $hasFooterCta = true; break; }
        }
        if ($hasFooterCta || $request->has('footer_cta_image') || $request->has('footer_cta_button_url')) {
            $footerCta = ContactPageInfo::first() ?? ContactPageInfo::create([]);
            $fieldMap = [
                'footer_cta_label' => 'cta_label', 'footer_cta_title' => 'cta_title',
                'footer_cta_description' => 'cta_description', 'footer_cta_button_text' => 'cta_button_text',
            ];
            foreach ($fieldMap as $reqField => $dbField) {
                if ($request->has($reqField)) {
                    $footerCta->setTranslation($dbField, $locale, $request->$reqField);
                }
            }
            if ($request->has('footer_cta_image')) { $footerCta->cta_image = $request->footer_cta_image; }
            if ($request->has('footer_cta_button_url')) { $footerCta->cta_button_url = $request->footer_cta_button_url; }
            $footerCta->save();
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Hakkımızda sayfası başarıyla güncellendi.');
    }

    private function editAboutTranslate(Request $request, $lang)
    {
        return redirect()->route('pages.edit', ['id' => 'about', 'lang' => $lang]);
    }

    private function updateAboutTranslate(Request $request)
    {
        $aboutPageInfo = AboutUsPageInfo::first();
        if (!$aboutPageInfo) {
            $aboutPageInfo = AboutUsPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'breadcrumb_title', 'breadcrumb_home', 'breadcrumb_current',
            'section1_label', 'section1_title', 'section1_description',
            'section1_stat_text',
            'categories_label', 'categories_title', 'categories_button_text',
            'logos_text',
            'section2_label', 'section2_title', 'section2_description',
            'section2_stat_text',
            'testimonial_label', 'testimonial_title',
            'faq_label', 'faq_title',
            'blog_label', 'blog_title',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $aboutPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Section 1 features
        if ($request->has('section1_features')) {
            $features = json_decode($request->section1_features, true);
            if (is_array($features)) {
                $aboutPageInfo->setTranslation('section1_features', $locale, $features);
            }
        }

        // Section 2 features
        if ($request->has('section2_features')) {
            $s2features = json_decode($request->section2_features, true);
            if (is_array($s2features)) {
                $aboutPageInfo->setTranslation('section2_features', $locale, $s2features);
            } else {
                $aboutPageInfo->setTranslation('section2_features', $locale, $request->section2_features);
            }
        }

        $aboutPageInfo->save();

        // Footer CTA (ContactPageInfo) translate
        $footerCtaTranslatable = ['footer_cta_label', 'footer_cta_title', 'footer_cta_description', 'footer_cta_button_text'];
        $hasFooterCta = false;
        foreach ($footerCtaTranslatable as $field) {
            if ($request->has($field)) { $hasFooterCta = true; break; }
        }
        if ($hasFooterCta) {
            $footerCta = ContactPageInfo::first() ?? ContactPageInfo::create([]);
            $fieldMap = [
                'footer_cta_label' => 'cta_label', 'footer_cta_title' => 'cta_title',
                'footer_cta_description' => 'cta_description', 'footer_cta_button_text' => 'cta_button_text',
            ];
            foreach ($fieldMap as $reqField => $dbField) {
                if ($request->has($reqField)) {
                    $footerCta->setTranslation($dbField, $locale, $request->$reqField);
                }
            }
            $footerCta->save();
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Çeviri kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Çeviri başarıyla güncellendi.');
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

        // Field styles
        if ($request->has('field_styles')) {
            $contactPageInfo->field_styles = json_decode($request->field_styles, true);
        }

        if ($request->has('default_styles')) {
            $contactPageInfo->default_styles = json_decode($request->default_styles, true);
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

        if ($request->has('field_styles')) {
            $faqPageInfo->field_styles = json_decode($request->field_styles, true);
        }

        if ($request->has('default_styles')) {
            $faqPageInfo->default_styles = json_decode($request->default_styles, true);
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

        // JSON style fields
        if ($request->has('field_styles')) {
            $teacherPageInfo->field_styles = json_decode($request->field_styles, true);
        }

        if ($request->has('default_styles')) {
            $teacherPageInfo->default_styles = json_decode($request->default_styles, true);
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

        // JSON style fields
        if ($request->has('field_styles')) {
            $blogPageInfo->field_styles = json_decode($request->field_styles, true);
        }

        if ($request->has('default_styles')) {
            $blogPageInfo->default_styles = json_decode($request->default_styles, true);
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

    // ─── Courses Page ──────────────────────────────────────────────────────────

    private function editCourses(Request $request)
    {
        $coursePageInfo = CoursePageInfo::first();
        if (!$coursePageInfo) {
            $coursePageInfo = CoursePageInfo::create([]);
        }

        $courses = Course::with('categories')->where('is_active', true)->orderBy('sort_order')->take(9)->get();

        $categories = CourseCategory::where('is_active', true)
            ->withCount(['courses' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-courses', compact('coursePageInfo', 'courses', 'categories', 'selectedLang', 'selectedLanguage'));
    }

    private function updateCourses(Request $request)
    {
        $coursePageInfo = CoursePageInfo::first();
        if (!$coursePageInfo) {
            $coursePageInfo = CoursePageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
            'search_placeholder', 'search_button_text', 'result_text',
            'detail_what_learn_title', 'detail_why_choose_title',
            'sidebar_info_title',
            'sidebar_price_label', 'sidebar_instructor_label',
            'sidebar_certification_label', 'sidebar_lessons_label',
            'sidebar_duration_label', 'sidebar_language_label', 'sidebar_students_label',
            'sidebar_contact_title',
            'sidebar_contact_phone_label', 'sidebar_contact_phone',
            'sidebar_contact_email_label', 'sidebar_contact_email',
            'sidebar_contact_address_label', 'sidebar_contact_address',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $coursePageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Non-translatable fields
        $nonTranslatableFields = ['cta_button_url', 'cta_image'];

        foreach ($nonTranslatableFields as $field) {
            if ($request->has($field)) {
                $coursePageInfo->$field = $request->$field;
            }
        }

        // JSON style fields
        if ($request->has('field_styles')) {
            $coursePageInfo->field_styles = json_decode($request->field_styles, true);
        }

        if ($request->has('default_styles')) {
            $coursePageInfo->default_styles = json_decode($request->default_styles, true);
        }

        $coursePageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Kurslar sayfası başarıyla güncellendi.');
    }

    private function editCoursesTranslate(Request $request, $lang)
    {
        return redirect()->route('pages.edit', ['id' => 'courses', 'lang' => $lang]);
    }

    private function updateCoursesTranslate(Request $request)
    {
        $coursePageInfo = CoursePageInfo::first();
        if (!$coursePageInfo) {
            $coursePageInfo = CoursePageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'title', 'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
            'search_placeholder', 'search_button_text', 'result_text',
            'detail_what_learn_title', 'detail_why_choose_title',
            'sidebar_info_title',
            'sidebar_price_label', 'sidebar_instructor_label',
            'sidebar_certification_label', 'sidebar_lessons_label',
            'sidebar_duration_label', 'sidebar_language_label', 'sidebar_students_label',
            'sidebar_contact_title',
            'sidebar_contact_phone_label', 'sidebar_contact_phone',
            'sidebar_contact_email_label', 'sidebar_contact_email',
            'sidebar_contact_address_label', 'sidebar_contact_address',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $coursePageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        $coursePageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Çeviri kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Çeviri başarıyla güncellendi.');
    }

    // ─── Footer ──────────────────────────────────────────────────────────────

    private function editFooter(Request $request)
    {
        $footerPageInfo = FooterPageInfo::first();
        if (!$footerPageInfo) {
            $footerPageInfo = FooterPageInfo::create([]);
        }

        $contactPageInfo = ContactPageInfo::first();
        if (!$contactPageInfo) {
            $contactPageInfo = ContactPageInfo::create([]);
        }

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-footer', compact('footerPageInfo', 'contactPageInfo', 'selectedLang', 'selectedLanguage'));
    }

    private function updateFooter(Request $request)
    {
        $footerPageInfo = FooterPageInfo::first();
        if (!$footerPageInfo) {
            $footerPageInfo = FooterPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        // Translatable fields
        $translatableFields = [
            'about_text', 'links_title', 'contact_title',
            'newsletter_title', 'newsletter_text', 'newsletter_button', 'newsletter_placeholder',
            'copyright_text', 'support_label', 'email_label', 'address_label',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $footerPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Social links
        if ($request->has('social_links')) {
            $socialLinks = $request->social_links;
            if (is_string($socialLinks)) {
                $socialLinks = json_decode($socialLinks, true) ?? [];
            }
            $footerPageInfo->social_links = $socialLinks;
        }

        // Nav links
        if ($request->has('nav_links')) {
            $navLinks = $request->nav_links;
            if (is_string($navLinks)) {
                $navLinks = json_decode($navLinks, true) ?? [];
            }
            $footerPageInfo->nav_links = $navLinks;
        }

        // Logo: file upload OR string path (from AJAX live preview)
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pages'), $filename);
            $footerPageInfo->logo = 'uploads/pages/' . $filename;
        } elseif ($request->has('logo')) {
            $footerPageInfo->logo = $request->logo ?: null;
        }

        $footerPageInfo->save();

        // Update contact info in ContactPageInfo
        $contactPageInfo = ContactPageInfo::first() ?? ContactPageInfo::create([]);
        $contactFields = ['phone_1', 'email_1', 'address_line_1'];
        foreach ($contactFields as $field) {
            if ($request->has($field)) {
                $contactPageInfo->$field = $request->$field;
            }
        }
        $contactPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Footer başarıyla güncellendi.');
    }

    private function editFooterTranslate(Request $request, $lang)
    {
        $footerPageInfo = FooterPageInfo::first();
        if (!$footerPageInfo) {
            $footerPageInfo = FooterPageInfo::create([]);
        }

        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-footer-translate', compact('footerPageInfo', 'selectedLang', 'selectedLanguage'));
    }

    private function updateFooterTranslate(Request $request)
    {
        $footerPageInfo = FooterPageInfo::first();
        if (!$footerPageInfo) {
            $footerPageInfo = FooterPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = [
            'about_text', 'links_title', 'contact_title',
            'newsletter_title', 'newsletter_text', 'newsletter_button', 'newsletter_placeholder',
            'copyright_text', 'support_label', 'email_label', 'address_label',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $footerPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Nav link label translations
        if ($request->has('nav_link_labels')) {
            $currentLinks = $footerPageInfo->nav_links ?? [];
            $labels = $request->nav_link_labels;
            foreach ($currentLinks as $i => &$link) {
                if (isset($labels[$i])) {
                    if (!is_array($link['label'])) {
                        $link['label'] = [app()->getLocale() => $link['label']];
                    }
                    $link['label'][$locale] = $labels[$i];
                }
            }
            $footerPageInfo->nav_links = $currentLinks;
        }

        $footerPageInfo->save();

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

    // ─── Navbar ────────────────────────────────────────────────────────────

    private function editNavbar(Request $request)
    {
        $navbarPageInfo = NavbarPageInfo::first();
        if (!$navbarPageInfo) {
            $navbarPageInfo = NavbarPageInfo::create([]);
        }

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        $navMenuItems = MenuItem::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order')
                  ->with(['children' => function ($q2) {
                      $q2->where('is_active', true)->orderBy('sort_order');
                  }]);
            }])
            ->orderBy('sort_order')
            ->get();

        return view('admin.pages.edit-navbar', compact('navbarPageInfo', 'selectedLang', 'selectedLanguage', 'navMenuItems'));
    }

    private function updateNavbar(Request $request)
    {
        $navbarPageInfo = NavbarPageInfo::first();
        if (!$navbarPageInfo) {
            $navbarPageInfo = NavbarPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        // Translatable fields
        $translatableFields = [
            'search_placeholder', 'search_button_text',
            'register_button_text', 'login_button_text',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $navbarPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Toggle fields
        $toggleFields = ['show_search', 'show_register_button', 'show_login_button', 'show_social_links', 'show_cart_button', 'show_side_info_button'];
        foreach ($toggleFields as $field) {
            if ($request->has($field)) {
                $navbarPageInfo->$field = (bool) $request->$field;
            }
        }

        $navbarPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Navbar başarıyla güncellendi.');
    }

    private function editNavbarTranslate(Request $request, $lang)
    {
        $navbarPageInfo = NavbarPageInfo::first();
        if (!$navbarPageInfo) {
            $navbarPageInfo = NavbarPageInfo::create([]);
        }

        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.pages.edit-navbar-translate', compact('navbarPageInfo', 'selectedLang', 'selectedLanguage'));
    }

    private function updateNavbarTranslate(Request $request)
    {
        $navbarPageInfo = NavbarPageInfo::first();
        if (!$navbarPageInfo) {
            $navbarPageInfo = NavbarPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        // Translatable fields
        $translatableFields = [
            'search_placeholder', 'search_button_text',
            'register_button_text', 'login_button_text',
        ];

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $navbarPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        // Nav items label translations
        if ($request->has('nav_item_labels')) {
            $navItems = $navbarPageInfo->nav_items ?? [];
            $labels = $request->nav_item_labels;

            // Recursive function to update labels
            $updateLabels = function (&$items, $labelData) use (&$updateLabels, $locale) {
                foreach ($items as $i => &$item) {
                    if (isset($labelData[$i])) {
                        if (!is_array($item['label'])) {
                            $item['label'] = [app()->getLocale() => $item['label']];
                        }
                        $item['label'][$locale] = $labelData[$i]['label'] ?? '';

                        if (!empty($item['children']) && isset($labelData[$i]['children'])) {
                            $updateLabels($item['children'], $labelData[$i]['children']);
                        }
                    }
                }
            };

            $updateLabels($navItems, $labels);
            $navbarPageInfo->nav_items = $navItems;
        }

        $navbarPageInfo->save();

        return redirect()->back()->with('success', 'Navbar çevirisi başarıyla güncellendi.');
    }

    // ─── Shop Pages ───────────────────────────────────────────────────────

    private function editShop(Request $request)
    {
        $shopPageInfo = ShopPageInfo::first();
        if (!$shopPageInfo) {
            $shopPageInfo = ShopPageInfo::create([]);
        }

        $localeInfo = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        $products = Product::where('is_active', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $categories = ProductCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        return view('admin.pages.edit-shop', compact('shopPageInfo', 'selectedLang', 'selectedLanguage', 'products', 'categories'));
    }

    private function updateShop(Request $request)
    {
        $shopPageInfo = ShopPageInfo::first();
        if (!$shopPageInfo) {
            $shopPageInfo = ShopPageInfo::create([]);
        }

        $locale = $request->lang ?? app()->getLocale();

        $translatableFields = $shopPageInfo->translatable;

        foreach ($translatableFields as $field) {
            if ($request->has($field)) {
                $shopPageInfo->setTranslation($field, $locale, $request->$field);
            }
        }

        if ($request->has('field_styles')) {
            $shopPageInfo->field_styles = json_decode($request->field_styles, true);
        }
        if ($request->has('default_styles')) {
            $shopPageInfo->default_styles = json_decode($request->default_styles, true);
        }

        $shopPageInfo->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kaydedildi.']);
        }

        return redirect()->back()->with('success', 'Mağaza sayfası başarıyla güncellendi.');
    }

    private function editShopTranslate(Request $request, $lang)
    {
        return redirect()->route('pages.edit', ['id' => 'shop', 'lang' => $lang]);
    }

    private function updateShopTranslate(Request $request)
    {
        return $this->updateShop($request);
    }
}
