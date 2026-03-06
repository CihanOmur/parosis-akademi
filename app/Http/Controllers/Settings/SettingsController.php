<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SitemapEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $general  = Setting::getGroup('general');
        $logos    = Setting::getGroup('logos');
        $seo      = Setting::getGroup('seo');
        $mail     = Setting::getGroup('mail');
        $social   = Setting::getGroup('social');
        $advanced = Setting::getGroup('advanced');
        $sitemapEntries = SitemapEntry::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.settings.index',
            compact('general', 'logos', 'seo', 'mail', 'social', 'advanced', 'sitemapEntries'));
    }

    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name'        => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_phone'       => 'nullable|string|max:50',
            'site_email'       => 'nullable|email|max:255',
            'site_address'     => 'nullable|string|max:500',
            'copyright_text'   => 'nullable|string|max:500',
            'timezone'         => 'nullable|string|max:50',
        ]);

        Setting::saveGroup('general', $request->only([
            'site_name', 'site_description', 'site_phone',
            'site_email', 'site_address', 'copyright_text', 'timezone',
        ]));

        return redirect()->route('settings.index', ['tab' => 'general'])
            ->with('success', 'Genel ayarlar kaydedildi.');
    }

    public function updateLogos(Request $request)
    {
        $request->validate([
            'header_logo' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'footer_logo' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'favicon'     => 'nullable|file|mimes:png,jpg,jpeg,ico,svg|max:512',
            'admin_logo'  => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:2048',
        ]);

        $logoFields = ['header_logo', 'footer_logo', 'favicon', 'admin_logo'];

        foreach ($logoFields as $field) {
            if ($request->hasFile($field)) {
                $file     = $request->file($field);
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                Setting::set($field, 'uploads/settings/' . $filename, 'logos');
            } elseif ($request->input('remove_' . $field) === '1') {
                Setting::set($field, '', 'logos');
            }
        }

        return redirect()->route('settings.index', ['tab' => 'logos'])
            ->with('success', 'Logo ayarları kaydedildi.');
    }

    public function updateSeo(Request $request)
    {
        $request->validate([
            'meta_title'            => 'nullable|string|max:255',
            'meta_description'      => 'nullable|string|max:500',
            'meta_keywords'         => 'nullable|string|max:500',
            'google_analytics_id'   => 'nullable|string|max:50',
            'google_tag_manager_id' => 'nullable|string|max:50',
            'sitemap_url'           => 'nullable|string|max:255',
            'robots_txt'            => 'nullable|string',
        ]);

        Setting::saveGroup('seo', $request->only([
            'meta_title', 'meta_description', 'meta_keywords',
            'google_analytics_id', 'google_tag_manager_id', 'sitemap_url', 'robots_txt',
        ]));

        return redirect()->route('settings.index', ['tab' => 'seo'])
            ->with('success', 'SEO ayarları kaydedildi.');
    }

    public function updateMail(Request $request)
    {
        $request->validate([
            'mail_mailer'       => 'required|in:smtp,log',
            'mail_host'         => 'nullable|string|max:255',
            'mail_port'         => 'nullable|integer|min:1|max:65535',
            'mail_username'     => 'nullable|string|max:255',
            'mail_password'     => 'nullable|string|max:255',
            'mail_encryption'   => 'nullable|in:tls,ssl,',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name'    => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'mail_mailer', 'mail_host', 'mail_port', 'mail_username',
            'mail_encryption', 'mail_from_address', 'mail_from_name',
        ]);

        if ($request->filled('mail_password')) {
            $data['mail_password'] = $request->mail_password;
        }

        Setting::saveGroup('mail', $data);

        return redirect()->route('settings.index', ['tab' => 'mail'])
            ->with('success', 'E-posta ayarları kaydedildi.');
    }

    public function testMail(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);

        $mailSettings = Setting::getGroup('mail');
        $this->applyMailConfig($mailSettings);

        try {
            Mail::raw('Bu bir test e-postasıdır. E-posta ayarlarınız doğru çalışıyor.', function ($message) use ($request, $mailSettings) {
                $message->to($request->test_email)
                    ->subject('Test E-postası — ' . Setting::get('site_name', 'Parosis Akademi'));
            });

            return redirect()->route('settings.index', ['tab' => 'mail'])
                ->with('success', 'Test e-postası başarıyla gönderildi.');
        } catch (\Exception $e) {
            return redirect()->route('settings.index', ['tab' => 'mail'])
                ->with('error', 'E-posta gönderilemedi: ' . $e->getMessage());
        }
    }

    public function updateSocial(Request $request)
    {
        $request->validate([
            'facebook_url'    => 'nullable|url|max:255',
            'twitter_url'     => 'nullable|url|max:255',
            'instagram_url'   => 'nullable|url|max:255',
            'linkedin_url'    => 'nullable|url|max:255',
            'youtube_url'     => 'nullable|url|max:255',
            'tiktok_url'      => 'nullable|url|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        Setting::saveGroup('social', $request->only([
            'facebook_url', 'twitter_url', 'instagram_url',
            'linkedin_url', 'youtube_url', 'tiktok_url', 'whatsapp_number',
        ]));

        return redirect()->route('settings.index', ['tab' => 'social'])
            ->with('success', 'Sosyal medya ayarları kaydedildi.');
    }

    public function updateAdvanced(Request $request)
    {
        Setting::saveGroup('advanced', [
            'maintenance_mode' => $request->has('maintenance_mode') ? '1' : '0',
            'custom_head_code' => $request->input('custom_head_code', ''),
            'custom_body_code' => $request->input('custom_body_code', ''),
        ]);

        return redirect()->route('settings.index', ['tab' => 'advanced'])
            ->with('success', 'Gelişmiş ayarlar kaydedildi.');
    }

    // ─── Sitemap Entries CRUD ────────────────────────────────────────────────

    public function storeSitemapEntry(Request $request)
    {
        $request->validate([
            'loc'        => 'required|url|max:2048',
            'changefreq' => 'required|in:always,hourly,daily,weekly,monthly,yearly,never',
            'priority'   => 'required|in:0.0,0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,1.0',
        ]);

        $entry = SitemapEntry::create($request->only('loc', 'changefreq', 'priority'));

        return response()->json($entry);
    }

    public function updateSitemapEntry(Request $request, SitemapEntry $sitemapEntry)
    {
        $request->validate([
            'loc'        => 'required|url|max:2048',
            'changefreq' => 'required|in:always,hourly,daily,weekly,monthly,yearly,never',
            'priority'   => 'required|in:0.0,0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,1.0',
        ]);

        $sitemapEntry->update($request->only('loc', 'changefreq', 'priority'));

        return response()->json($sitemapEntry);
    }

    public function toggleSitemapEntry(SitemapEntry $sitemapEntry)
    {
        $sitemapEntry->update(['is_active' => !$sitemapEntry->is_active]);

        return response()->json(['success' => true]);
    }

    public function destroySitemapEntry(SitemapEntry $sitemapEntry)
    {
        $sitemapEntry->delete();

        return response()->json(['success' => true]);
    }

    private function applyMailConfig(array $s): void
    {
        config([
            'mail.default'                 => $s['mail_mailer'] ?? 'log',
            'mail.mailers.smtp.host'       => $s['mail_host'] ?? '',
            'mail.mailers.smtp.port'       => (int) ($s['mail_port'] ?? 587),
            'mail.mailers.smtp.username'   => $s['mail_username'] ?? '',
            'mail.mailers.smtp.password'   => $s['mail_password'] ?? '',
            'mail.mailers.smtp.encryption' => $s['mail_encryption'] ?? 'tls',
            'mail.from.address'            => $s['mail_from_address'] ?? '',
            'mail.from.name'               => $s['mail_from_name'] ?? '',
        ]);
    }
}
