<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Footer "Haber Al" e-bülten aboneliği. Sonuç/hata aynı sayfada footer formuna (#e-bulten) döner.
 */
class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $back = $this->backToForm();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:190',
        ], ValidationMessageService::getMessagesForLocale('newsletter_subscribe', 'front.validation.newsletter_subscribe'));

        if ($validator->fails()) {
            return redirect()->to($back)->withErrors($validator, 'newsletter')->withInput($request->only('email'));
        }

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => mb_strtolower(trim($request->input('email')))],
            ['locale' => app()->getLocale(), 'ip_address' => $request->ip()]
        );

        return redirect()->to($back)->with(
            'newsletter_status',
            $subscriber->wasRecentlyCreated ? __('front.newsletter_subscribed') : __('front.newsletter_already')
        );
    }

    /** Formun bulunduğu sayfa (yalnız sitenin kendi adresi) + footer formu çapası. */
    private function backToForm(): string
    {
        $previous = url()->previous();
        $base = url('/');
        $url = str_starts_with($previous, $base . '/') ? strtok($previous, '#') : route('front.home');

        return $url . '#e-bulten';
    }
}
