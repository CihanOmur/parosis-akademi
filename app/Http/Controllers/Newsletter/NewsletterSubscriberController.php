<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

/**
 * Panel → E-bülten Aboneleri (permission:newsletter / newsletter_delete).
 */
class NewsletterSubscriberController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $subscribers = NewsletterSubscriber::query()
            ->when($q !== '', fn ($w) => $w->where('email', 'like', "%{$q}%"))
            ->orderByDesc('created_at')
            ->paginate(25)
            ->withQueryString();
        $totalCount = NewsletterSubscriber::count();

        return view('admin.newsletter.index', compact('subscribers', 'totalCount'));
    }

    public function export()
    {
        $rows = NewsletterSubscriber::orderBy('created_at')->get(['email', 'locale', 'created_at']);

        // Excel formül enjeksiyonuna karşı: = + - @ ile başlayan hücrelerin başına ' konur
        $safe = fn ($v) => preg_match('/^[=+\-@\t\r]/', (string) $v) ? "'" . $v : $v;

        return response()->streamDownload(function () use ($rows, $safe) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // Excel'de Türkçe karakterler için BOM
            fputcsv($out, ['E-posta', 'Dil', 'Abone olma tarihi'], ';');
            foreach ($rows as $r) {
                fputcsv($out, [$safe($r->email), $r->locale, $r->created_at?->format('d.m.Y H:i')], ';');
            }
            fclose($out);
        }, 'e-bulten-aboneleri-' . now()->format('Y-m-d') . '.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function destroy($id)
    {
        NewsletterSubscriber::findOrFail($id)->delete();

        return back()->with('success', 'Abone silindi.');
    }
}
