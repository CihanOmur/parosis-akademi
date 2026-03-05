<?php

namespace App\Http\Controllers;

use App\Models\Blogs\Blog;
use App\Models\Courses\Course;
use App\Models\Shop\Product;
use App\Models\SitemapEntry;
use App\Models\Teacher\Teacher;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect();

        // Statik sayfalar
        $statics = [
            ['loc' => route('front.home'),     'priority' => '1.0',  'changefreq' => 'daily'],
            ['loc' => route('front.about'),    'priority' => '0.8',  'changefreq' => 'monthly'],
            ['loc' => route('front.courses'),  'priority' => '0.9',  'changefreq' => 'weekly'],
            ['loc' => route('front.teachers'), 'priority' => '0.8',  'changefreq' => 'weekly'],
            ['loc' => route('front.blog'),     'priority' => '0.9',  'changefreq' => 'daily'],
            ['loc' => route('front.products'), 'priority' => '0.9',  'changefreq' => 'daily'],
            ['loc' => route('front.contact'),  'priority' => '0.7',  'changefreq' => 'monthly'],
            ['loc' => route('front.faq'),      'priority' => '0.6',  'changefreq' => 'monthly'],
        ];

        foreach ($statics as $s) {
            $urls->push($s);
        }

        // Kurslar
        Course::where('is_active', true)
            ->select('id', 'updated_at')
            ->orderByDesc('updated_at')
            ->each(function ($item) use ($urls) {
                $urls->push([
                    'loc'        => route('front.course.details', $item->id),
                    'lastmod'    => $item->updated_at?->toW3cString(),
                    'priority'   => '0.8',
                    'changefreq' => 'weekly',
                ]);
            });

        // Eğitmenler
        Teacher::where('is_active', true)
            ->select('id', 'updated_at')
            ->orderByDesc('updated_at')
            ->each(function ($item) use ($urls) {
                $urls->push([
                    'loc'        => route('front.teacher.details', $item->id),
                    'lastmod'    => $item->updated_at?->toW3cString(),
                    'priority'   => '0.7',
                    'changefreq' => 'monthly',
                ]);
            });

        // Blog yazıları
        Blog::where('is_active', true)
            ->select('id', 'updated_at')
            ->orderByDesc('updated_at')
            ->each(function ($item) use ($urls) {
                $urls->push([
                    'loc'        => route('front.blog.details', $item->id),
                    'lastmod'    => $item->updated_at?->toW3cString(),
                    'priority'   => '0.7',
                    'changefreq' => 'weekly',
                ]);
            });

        // Ürünler
        Product::where('is_active', true)
            ->select('id', 'updated_at')
            ->orderByDesc('updated_at')
            ->each(function ($item) use ($urls) {
                $urls->push([
                    'loc'        => route('front.product.details', $item->id),
                    'lastmod'    => $item->updated_at?->toW3cString(),
                    'priority'   => '0.8',
                    'changefreq' => 'daily',
                ]);
            });

        // Özel sitemap girişleri
        SitemapEntry::where('is_active', true)
            ->orderBy('sort_order')
            ->each(function ($entry) use ($urls) {
                $urls->push([
                    'loc'        => $entry->loc,
                    'lastmod'    => $entry->updated_at?->toW3cString(),
                    'priority'   => $entry->priority,
                    'changefreq' => $entry->changefreq,
                ]);
            });

        $xml = $this->buildXml($urls);

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    private function buildXml($urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
            if (!empty($url['lastmod'])) {
                $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
            }
            if (!empty($url['changefreq'])) {
                $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";
            }
            if (!empty($url['priority'])) {
                $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            }
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
