<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\ValidationMessageService;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'contact-name'  => 'required|string|max:255',
            'contact-email' => 'required|email|max:255',
            'message'       => 'required|string|max:5000',
        ], ValidationMessageService::getMessages('contact_send'));

        $toEmail = Setting::get('site_email', null, 'general');

        if ($toEmail) {
            try {
                Mail::to($toEmail)->send(new ContactFormMail(
                    contactName: $request->input('contact-name'),
                    contactEmail: $request->input('contact-email'),
                    contactMessage: $request->input('message'),
                ));
            } catch (\Exception $e) {
                \Log::error('Contact form mail failed: ' . $e->getMessage());
            }
        }

        return redirect()->route('front.contact')
            ->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
    }
}
